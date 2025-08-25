<?php

namespace Manoar\SpellMoney\Languages;

use Manoar\SpellMoney\Contracts\LanguageInterface;

abstract class BaseLanguage implements LanguageInterface
{
    /**
     * Get basic numbers (0-99)
     *
     * @return array
     */
    abstract public function getBasicNumbers(): array;

    /**
     * Get separators for place values
     *
     * @return array
     */
    abstract public function getSeparators(): array;

    /**
     * Get currency names
     *
     * @return array
     */
    abstract public function getCurrencyNames(): array;

    /**
     * Get connecting words
     *
     * @return array
     */
    abstract public function getConnectors(): array;

    /**
     * Get negative word
     *
     * @return string
     */
    abstract public function getNegativeWord(): string;

    /**
     * Get zero word
     *
     * @return string
     */
    abstract public function getZeroWord(): string;

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
