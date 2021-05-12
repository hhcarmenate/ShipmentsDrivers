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
        $this->drivers->each(function($driver){
            new CalculateSuitableScore($this->street_name, $driver);
        });
    }

    /**
     * Set Actual assigned driver
     * @param DriversData $driversData
     */
    public function setDriverAssigned(DriversData $driversData)
    {
        $this->driver_assigned = $driversData;
    }

    /**
     * Get the assigned driver
     * @return DriversData|null
     */
    public function getDriverAssigned()
    {
        return $this->driver_assigned;
    }

    /**
     * Get the drivers collection with each suitable score
     * @return Collection
     */
    public function getDrivers()
    {
        return $this->drivers;
    }
}
