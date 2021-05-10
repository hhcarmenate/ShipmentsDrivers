<?php

namespace Tests\Unit\CalculateSuitableScore;

use App\Http\Support\Shipments\CalculateSuitableScore;
use App\Http\Support\Shipments\DriversData;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CalculateSuitableScoreTest extends TestCase
{
    /**
     * A basic object creation.
     * @test
     * @return void
     */
    public function can_create_calculate_suitable_score_object()
    {
        $first_name = "John";
        $last_name = "Do";

        $drivers_data = $this->mockingDriversData($first_name, $last_name);
        $calculate_suitable_score = new CalculateSuitableScore('Street Name Test', $drivers_data);
        $this->assertInstanceOf(CalculateSuitableScore::class, $calculate_suitable_score);
    }

    /**
     * Testing suitable score without common factor
     * @test
     */
    public function calculate_suitable_score_for_even_without_common_factor()
    {
        $street_name_even = 'Street name even';
        $drivers_data = new DriversData("john","Do");

        new CalculateSuitableScore($street_name_even, $drivers_data);

        $this->assertEquals(2 * 1.5, $drivers_data->getSuitabilityScore());
    }

    /**
     * Testing suitable score with common factor
     * @test
     */
    public function calculate_suitable_score_for_even_with_common_factor()
    {
        $street_name_even = 'Street name even';
        $drivers_data = new DriversData("jon","Do");

        new CalculateSuitableScore($street_name_even, $drivers_data);
        $this->assertEquals(2 * 1.5 + 2 * 1.5 * 1/2, $drivers_data->getSuitabilityScore());
    }

    /**
     * Testing suitable score without common factor
     * @test
     */
    public function calculate_suitable_score_for_odd_without_common_factor()
    {
        $street_name_even = 'Street name odd';
        $drivers_data = new DriversData("john","Do");

        new CalculateSuitableScore($street_name_even, $drivers_data);

        $this->assertEquals(4, $drivers_data->getSuitabilityScore());
    }

    /**
     * Testing suitable score without common factor
     * @test
     */
    public function calculate_suitable_score_for_odd_with_common_factor()
    {
        $street_name_even = 'eStreet name odd not even';
        $drivers_data = new DriversData("jo","Do");

        new CalculateSuitableScore($street_name_even, $drivers_data);

        $this->assertEquals(2 + 2 * 1/2, $drivers_data->getSuitabilityScore());
    }


    /**
     * Preparing Drivers data mock
     * @param $first_name
     * @param $last_name
     * @return MockObject
     */
    private function mockingDriversData($first_name, $last_name)
    {
        $drivers_data = $this->getMockBuilder(DriversData::class)
            ->setConstructorArgs([$first_name, $last_name])
            ->getMock();
        $drivers_data->expects($this->once())
            ->method('getCompletedName')
            ->willReturn("{$first_name} {$last_name}");
        return $drivers_data;
    }
}
