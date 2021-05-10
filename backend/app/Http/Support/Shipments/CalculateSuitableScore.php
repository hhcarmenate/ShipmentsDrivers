<?php


namespace App\Http\Support\Shipments;


class CalculateSuitableScore
{
    private string $street_name;

    private DriversData $driver;

    /**
     * CalculateSuitableScore constructor.
     * @param string $street_name
     * @param DriversData $driver
     */
    public function __construct(string $street_name, DriversData $driver)
    {
        $this->street_name = $street_name;
        $this->driver = $driver;
        $this->suitableScore();
    }

    /**
     * Calculate and set suitable score
     */
    private function suitableScore()
    {
        $suitable_score = $this->handleSuitableScore();
        if($this->calculateCommonFactor()) {
            $suitable_score = $suitable_score + $suitable_score * 1/2;
        }
        $this->driver->setSuitableScore($suitable_score);
    }

    /**
     * Get the string lengths and the defining params for algorithm
     * @return bool
     */
    private function calculateCommonFactor()
    {
        $street_length = strlen($this->street_name);
        $driver_length = strlen($this->driver->getCompletedName());
        if($street_length > $driver_length) {
            $param1 = $street_length;
            $param2 = $driver_length;
        } else {
            $param2 = $street_length;
            $param1 = $driver_length;
        }
        return ($this->commonFactorEuclid($param1, $param2) === 1) ? false : true;
    }

    /**
     * Recursive common factor using Euclid's Algorithm
     * @param $number1
     * @param $number2
     * @return mixed
     */
    private function commonFactorEuclid($number1, $number2)
    {
        $rest = $number1 % $number2;
        if($rest <= 0) {
            return $number2;
        }
        return $this->commonFactorEuclid($number2,  $rest);
    }

    /**
     * Handle suitable score
     * @return float|int
     */
    private function handleSuitableScore()
    {
        if($this->isEven()) {
            return $this->driver->getVowels() * 1.5;
        }
        return $this->driver->getConsonants();
    }

    /**
     * Check if street name length is event or odd
     * @return bool
     */
    private function isEven()
    {
        return ( strlen($this->street_name) % 2 === 0 );
    }
}
