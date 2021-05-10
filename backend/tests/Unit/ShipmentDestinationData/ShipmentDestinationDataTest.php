<?php

namespace Tests\Unit\ShipmentDestinationData;

use App\Http\Support\Shipments\DriversData;
use App\Http\Support\Shipments\ShipmentDestinationData;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class ShipmentDestinationDataTest extends TestCase
{
    /**
     * A basic object creation.
     * @test
     * @return void
     */
    public function can_create_shipment_destination_data_object()
    {
        $address = $this->getAddress();
        $drivers = $this->getDriversCollection();

        $shipment_destination = new ShipmentDestinationData($address, $drivers);
        $this->assertInstanceOf(ShipmentDestinationData::class, $shipment_destination);
    }

    /**
     * Get the driver with greater suitable score
     * @test
     * @return void
     */
    public function get_driver_with_greater_suitable_score()
    {
        $address = $this->getAddress();//19 characters street length
        $drivers = collect();

        $driver1 = new DriversData("john", "Doe");//4 points of suitable score
        $driver2 = new DriversData("Janne","Does");//7.5 points of suitable score removing first part of address to get the street name

        $drivers->push($driver1);
        $drivers->push($driver2);

        $shipment_destination = new ShipmentDestinationData($address, $drivers);
        $this->assertInstanceOf(DriversData::class, $shipment_destination->driver_assigned);
        $this->assertSame($shipment_destination->driver_assigned, $driver2);
        $this->assertEquals(7.5, $shipment_destination->driver_assigned->getSuitabilityScore());
    }


    /**
     * Helper function to get the address
     * @return string[]
     */
    private function getAddress()
    {
        return [
            'address' => '123 testing Address'
        ];
    }

    /**
     * Generate Drivers Collection
     * @return Collection
     */
    private function getDriversCollection()
    {
        $drivers = collect();
        $faker = \Faker\Factory::create();
        for($i = 0; $i <= rand(1,10); $i ++) {
            $drivers->push(new DriversData($faker->firstName(), $faker->lastName()));
        }
        return $drivers;
    }
}
