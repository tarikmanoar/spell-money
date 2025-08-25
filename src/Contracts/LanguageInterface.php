<?php

namespace Manoar\SpellMoney\Contracts;

interface LanguageInterface
{
    /**
     * Get basic numbers (0-99)
     *
     * @return array
     */
    public function getBasicNumbers(): array;

    /**
     * Get separators for place values
     *
     * @return array
     */
    public function getSeparators(): array;

    /**
     * Get international separators for place values
     *
     * @return array
     */
    public function getInternationalSeparators(): array;

    /**
     * Get currency names
     *
     * @return array
     */
    public function getCurrencyNames(): array;

    /**
     * Get connecting words
     *
     * @return array
     */
    public function getConnectors(): array;

    /**
     * Get negative word
     *
     * @return string
     */
    public function getNegativeWord(): string;

    /**
     * Get zero word
     *
     * @return string
     */
    public function getZeroWord(): string;
}
