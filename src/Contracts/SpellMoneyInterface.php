<?php

namespace Manoar\SpellMoney\Contracts;

interface SpellMoneyInterface
{
    /**
     * Convert a number to words
     *
     * @param float|int $number
     * @param array $options
     * @return string
     */
    public function toWords($number, array $options = []): string;

    /**
     * Convert a number to currency words
     *
     * @param float|int $number
     * @param array $options
     * @return string
     */
    public function toCurrency($number, array $options = []): string;

    /**
     * Set the language for conversion
     *
     * @param string $language
     * @return self
     */
    public function setLanguage(string $language): self;

    /**
     * Set the number system (south_asian or international)
     *
     * @param string $system
     * @return self
     */
    public function setNumberSystem(string $system): self;

    /**
     * Set currency options
     *
     * @param string $currency
     * @param string $subunit
     * @return self
     */
    public function setCurrency(string $currency, string $subunit): self;

    /**
     * Set case formatting
     *
     * @param string $case
     * @return self
     */
    public function setCase(string $case): self;

    /**
     * Set decimal precision
     *
     * @param int $precision
     * @return self
     */
    public function setDecimalPrecision(int $precision): self;
}
