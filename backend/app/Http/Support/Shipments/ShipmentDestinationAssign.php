<?php


namespace App\Http\Support\Shipments;


use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ShipmentDestinationAssign
{
    private array $shipments_data;

    private array $drivers_data;

    /**
     * ShipmentDestinationAssign constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->shipments_data = $request->input('shipments_data');
        $this->drivers_data = $request->input('drivers_data');
    }

    /**
     * Handle Shipment destinations
     * @return array
     */
    public function getShipmentsData()
    {
        $destination_collection = collect();
        if(count($this->shipments_data)) {
            foreach($this->shipments_data as $shipment) {
                $destination_collection->push(new ShipmentDestinationData($shipment, $this->getDriversCollection($this->drivers_data)));
            }
        }
        return $this->maximizeSuitableScore($destination_collection);
    }


    /**
     * Get all possible combination using nPk = n!/(n-k)! formula
     * @param $drivers
     * @return \Generator
     */
    private function getAllCombinations($drivers)
    {
        if (count($drivers) <= 1) {
            yield $drivers;
        } else {
            foreach ($this->getAllCombinations(array_slice($drivers, 1)) as $permutation) {
                foreach (range(0, count($drivers) - 1) as $i) {
                    yield array_merge(
                        array_slice($permutation, 0, $i),
                        [$drivers[0]],
                        array_slice($permutation, $i)
                    );
                }
            }
        }
    }

    /**
     * Handle drivers data
     * @return array
     */
    private function handleDriversData()
    {
        $temp = [];
        if(count($this->drivers_data)) {
            foreach($this->drivers_data as $driver) {
                $temp[] = "{$driver["first_name"]} {$driver["last_name"]}";
            }
        }
        return $temp;
    }

    /**
     * Calculate maximus suitable score base in all permutations
     * @param $destination_score
     * @return array
     */
    private function maximizeSuitableScore($destination_score)
    {
        $result = $this->getAllCombinations($this->handleDriversData());
        $greater_permutation = [
            'permutation'   => [],
            'score_sum'     => 0
        ];
        foreach ($result as $key => $item) {
            $combination = [];
            $score_sum = 0;
            foreach($item as $index => $driver){
                $destination = $destination_score->slice($index, 1);
                $suitable_score = $this->getSuitableScore($destination, $driver);
                $combination[] = [
                    'driver'            => $driver,
                    'destination'       => $destination->first()->address,
                    'suitable_score'    => $suitable_score
                ];
                $score_sum = $score_sum + $suitable_score;
            }
            if($greater_permutation['score_sum'] < $score_sum) {
                $greater_permutation = [
                    'permutation'   => $combination,
                    'score_sum'     => $score_sum
                ];
            }
        }

       return $greater_permutation;
    }



    /**
     * Get suitable score
     * @param $destination
     * @param $driver_name
     * @return int
     */
    private function getSuitableScore($destination, $driver_name)
    {
        $suitable_score = 0;
        $destination->first()->getDrivers()->each(function($driver) use($driver_name, &$suitable_score){
            if($driver->getCompletedName() === $driver_name) {
                $suitable_score = $driver->getSuitabilityScore();
            }
        });
        return $suitable_score;
    }

     /**
     * Get actual driver collection
     * @param array $drivers
     * @return Collection
     */
    private function getDriversCollection(array $drivers)
    {
        $drivers_collection = collect();
        if (count($drivers)) {
            foreach ($drivers as $driver) {
                $drivers_collection->push(new DriversData($driver["first_name"], $driver["last_name"]));
            }
        }
        return $drivers_collection;
    }
}
