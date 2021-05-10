<?php


namespace App\Http\Support\Shipments;


use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class ShipmentDestinationAssign
{
    private array $shipments_data;

    private Collection $drivers_data;

    /**
     * ShipmentDestinationAssign constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->shipments_data = $request->input('shipments_data');
        $this->drivers_data = $this->getDriversCollection($request->input('drivers_data'));
    }

    /**
     * Handle Shipment destinations
     * @return Collection
     */
    public function getShipmentsData()
    {
        $destination_collection = collect();
        if(count($this->shipments_data)) {
            foreach($this->shipments_data as $shipment) {
                $destination_collection->push(new ShipmentDestinationData($shipment, $this->drivers_data));
            }
        }
        return $destination_collection;
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
