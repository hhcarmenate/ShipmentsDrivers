<?php


namespace App\Http\Support\Shipments;

use Illuminate\Support\Collection;

class ShipmentDestinationData
{
    const STREET_END = [
        'Avenue',
        'Road',
        'Lane',
        'Street',
    ];

    public string $address;

    private Collection $drivers;

    public ?DriversData $driver_assigned;

    private string $street_name;


    /**
     * ShipmentDestinationHandle constructor.
     * @param $shipment_destination
     * @param $drivers
     */
    public function __construct(array $shipment_destination, Collection $drivers)
    {
        $this->address = $shipment_destination['address'] ?? '';
        $this->drivers = $drivers;
        $this->street_name = $this->getStreetName();
        $this->calculateSuitableScore();
    }

    /**
     * Get just the street name
     * @return string
     */
    private function getStreetName()
    {
        $street = "";
        $address_parts = explode(" ",$this->address);
        if(count($address_parts)) {
            foreach($address_parts as $key => $part) {
                if($key !== 0 && !in_array($part,self::STREET_END)){
                    $street = ($key === 1) ? $part : "{$street} {$part}";
                }
            }
        }
        return $street;
    }

    /**
     * Calculate and assign suitable score
     */
    private function calculateSuitableScore()
    {
        $driver_assigned = null;
        $max_suitable_score = 0;
        $key_selected = 0;
        $this->drivers->each(function($driver,$index) use(&$max_suitable_score, &$driver_assigned, &$key_selected){
            new CalculateSuitableScore($this->street_name, $driver);
            $suitable_score = $driver->getSuitabilityScore();
            if($max_suitable_score < $suitable_score) {
                $driver_assigned = $driver;
                $max_suitable_score = $suitable_score;
                $key_selected = $index;
            }
        });
        $this->driver_assigned = $driver_assigned;
        $this->drivers->forget($key_selected);
    }
}
