<?php

namespace Tests\Unit\DriversData;

use App\Http\Support\Shipments\DriversData;
use Faker\Factory;
use Faker\Generator;
use PHPUnit\Framework\TestCase;

class DriversDataTest extends TestCase
{
    /**
     * A basic object creation.
     * @test
     * @return void
     */
    public function can_create_drivers_data_object()
    {
        $first_name = "John";
        $last_name = "Doe";

        $drivers_data = new DriversData($first_name, $last_name);

        $this->assertInstanceOf(DriversData::class, $drivers_data);
    }

    /**
     * Testing completed name format
     * @test
     */
    public function completed_name_format()
    {
        $first_name = "John";
        $last_name = "Doe";

        $drivers_data = new DriversData($first_name, $last_name);

        $this->assertEquals($first_name." ".$last_name, $drivers_data->getCompletedName());
    }

    /**
     * Testing get and set for suitable score
     * @test
     */
    public function set_get_suitable_score()
    {
        $first_name = "John";
        $last_name = "Doe";

        $drivers_data = new DriversData($first_name, $last_name);
        $drivers_data->setSuitableScore(10.5);
        $this->assertEquals(10.5, $drivers_data->getSuitabilityScore());
    }

    /**
     * Testing vowels and consonants count
     * @test
     */
    public function count_vowels_and_consonants()
    {
        $first_name = "John";
        $last_name = "Doe";

        $drivers_data = new DriversData($first_name, $last_name);

        $this->assertEquals(3, $drivers_data->getVowels());
        $this->assertEquals(4, $drivers_data->getConsonants());

        $first_name2 = "caribbean";
        $last_name2 = "hurricane";

        $drivers_data2 = new DriversData($first_name2, $last_name2);

        $this->assertEquals(8, $drivers_data2->getVowels());
        $this->assertEquals(10, $drivers_data2->getConsonants());
    }
}
