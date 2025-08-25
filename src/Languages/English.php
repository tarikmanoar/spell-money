<?php

namespace Manoar\SpellMoney\Languages;

class English extends BaseLanguage
{
    /**
     * Get basic numbers (0-99)
     *
     * @return array
     */
    public function getBasicNumbers(): array
    {
        return [
            0 => "zero", 1 => "one", 2 => "two", 3 => "three", 4 => "four",
            5 => "five", 6 => "six", 7 => "seven", 8 => "eight", 9 => "nine",
            10 => "ten", 11 => "eleven", 12 => "twelve", 13 => "thirteen", 14 => "fourteen",
            15 => "fifteen", 16 => "sixteen", 17 => "seventeen", 18 => "eighteen", 19 => "nineteen",
            20 => "twenty", 30 => "thirty", 40 => "forty", 50 => "fifty",
            60 => "sixty", 70 => "seventy", 80 => "eighty", 90 => "ninety"
        ];
    }

    /**
     * Get separators for place values (South Asian)
     *
     * @return array
     */
    public function getSeparators(): array
    {
        return [
            0 => "",
            1 => "hundred",
            2 => "thousand",
            3 => "lakh",
            4 => "crore"
        ];
    }

    /**
     * Get currency names
     *
     * @return array
     */
    public function getCurrencyNames(): array
    {
        return [
            'currency' => 'taka',
            'subunit' => 'paisa'
        ];
    }

    /**
     * Get connecting words
     *
     * @return array
     */
    public function getConnectors(): array
    {
        return [
            'and' => 'and',
            'minus' => 'minus',
            'point' => 'point'
        ];
    }

    /**
     * Get negative word
     *
     * @return string
     */
    public function getNegativeWord(): string
    {
        return 'minus';
    }

    /**
     * Get zero word
     *
     * @return string
     */
    public function getZeroWord(): string
    {
        return 'zero';
    }

    /**
     * Get international separators for place values
     *
     * @return array
     */
    public function getInternationalSeparators(): array
    {
        return [
            0 => "",
            1 => "hundred",
            2 => "thousand",
            3 => "million",
            4 => "billion",
            5 => "trillion"
        ];
    }
}
