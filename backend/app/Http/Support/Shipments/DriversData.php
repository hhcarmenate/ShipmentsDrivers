<?php


namespace App\Http\Support\Shipments;


class DriversData
{
    private string $first_name;

    private string $last_name;

    private string $completed_name;

    private float $suitability_score;

    private int $vowels;

    private int $consonants;


    /**
     * DriversData constructor.
     * @param string $first_name
     * @param string $last_name
     */
    public function __construct(string $first_name, string $last_name)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->vowels = 0;
        $this->consonants = 0;
        $this->suitability_score = 0;
        $this->completed_name = "{$this->first_name} {$this->last_name}";
        $this->countVowelsAndConsonants();
    }

    /**
     * Get Completed Name
     * @return string
     */
    public function getCompletedName() {
        return $this->completed_name;
    }

    /**
     * Get Suitable Score
     * @return float|int
     */
    public function getSuitabilityScore()
    {
        return $this->suitability_score;
    }

    /**
     * Set suitable score value
     * @param $suitability_score
     */
    public function setSuitableScore(float $suitability_score)
    {
        $this->suitability_score = $suitability_score;
    }

    /**
     * Count and set vowels and consonants
     */
    private function countVowelsAndConsonants()
    {
        $lower_driver = strtolower($this->completed_name);

        foreach(str_split($lower_driver) as $chart) {
            $consonant_or_vowel = $this->isVowelOrConsonant($chart);
            if($consonant_or_vowel === 'vowel') {
                $this->vowels++;
            }

            if($consonant_or_vowel === 'consonant') {
                $this->consonants++;
            }
        }
    }

    /**
     * Define is one character is consonant or vowels or neither
     * @param $chart
     * @return false|string
     */
    private function isVowelOrConsonant($chart)
    {
        $vowels_array = ['a', 'e', 'i', 'o', 'u'];
        $consonants_array = str_split('bcdfghjklmnpqrstvwxyz');

        if(in_array($chart, $vowels_array)){
            return 'vowel';
        }

        if(in_array($chart, $consonants_array)) {
            return 'consonant';
        }

        return false;
    }

    /**
     * Function get Vowels to get access to vowels count
     * @return int
     */
    public function getVowels()
    {
        return $this->vowels;
    }


    /**
     * Function get Consonants to get access to consonants count
     * @return int
     */
    public function getConsonants()
    {
        return $this->consonants;
    }

}
