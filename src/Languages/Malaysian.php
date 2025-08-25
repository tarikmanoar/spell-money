<?php

namespace Manoar\SpellMoney\Languages;

class Malaysian extends BaseLanguage
{
    /**
     * Get basic numbers (0-99)
     *
     * @return array
     */
    public function getBasicNumbers(): array
    {
        return [
            0 => "kosong", 1 => "satu", 2 => "dua", 3 => "tiga", 4 => "empat",
            5 => "lima", 6 => "enam", 7 => "tujuh", 8 => "lapan", 9 => "sembilan",
            10 => "sepuluh", 11 => "sebelas", 12 => "dua belas", 13 => "tiga belas", 14 => "empat belas",
            15 => "lima belas", 16 => "enam belas", 17 => "tujuh belas", 18 => "lapan belas", 19 => "sembilan belas",
            20 => "dua puluh", 21 => "dua puluh satu", 22 => "dua puluh dua", 23 => "dua puluh tiga", 24 => "dua puluh empat",
            25 => "dua puluh lima", 26 => "dua puluh enam", 27 => "dua puluh tujuh", 28 => "dua puluh lapan", 29 => "dua puluh sembilan",
            30 => "tiga puluh", 31 => "tiga puluh satu", 32 => "tiga puluh dua", 33 => "tiga puluh tiga", 34 => "tiga puluh empat",
            35 => "tiga puluh lima", 36 => "tiga puluh enam", 37 => "tiga puluh tujuh", 38 => "tiga puluh lapan", 39 => "tiga puluh sembilan",
            40 => "empat puluh", 41 => "empat puluh satu", 42 => "empat puluh dua", 43 => "empat puluh tiga", 44 => "empat puluh empat",
            45 => "empat puluh lima", 46 => "empat puluh enam", 47 => "empat puluh tujuh", 48 => "empat puluh lapan", 49 => "empat puluh sembilan",
            50 => "lima puluh", 51 => "lima puluh satu", 52 => "lima puluh dua", 53 => "lima puluh tiga", 54 => "lima puluh empat",
            55 => "lima puluh lima", 56 => "lima puluh enam", 57 => "lima puluh tujuh", 58 => "lima puluh lapan", 59 => "lima puluh sembilan",
            60 => "enam puluh", 61 => "enam puluh satu", 62 => "enam puluh dua", 63 => "enam puluh tiga", 64 => "enam puluh empat",
            65 => "enam puluh lima", 66 => "enam puluh enam", 67 => "enam puluh tujuh", 68 => "enam puluh lapan", 69 => "enam puluh sembilan",
            70 => "tujuh puluh", 71 => "tujuh puluh satu", 72 => "tujuh puluh dua", 73 => "tujuh puluh tiga", 74 => "tujuh puluh empat",
            75 => "tujuh puluh lima", 76 => "tujuh puluh enam", 77 => "tujuh puluh tujuh", 78 => "tujuh puluh lapan", 79 => "tujuh puluh sembilan",
            80 => "lapan puluh", 81 => "lapan puluh satu", 82 => "lapan puluh dua", 83 => "lapan puluh tiga", 84 => "lapan puluh empat",
            85 => "lapan puluh lima", 86 => "lapan puluh enam", 87 => "lapan puluh tujuh", 88 => "lapan puluh lapan", 89 => "lapan puluh sembilan",
            90 => "sembilan puluh", 91 => "sembilan puluh satu", 92 => "sembilan puluh dua", 93 => "sembilan puluh tiga", 94 => "sembilan puluh empat",
            95 => "sembilan puluh lima", 96 => "sembilan puluh enam", 97 => "sembilan puluh tujuh", 98 => "sembilan puluh lapan", 99 => "sembilan puluh sembilan"
        ];
    }

    /**
     * Get separators for place values (International system)
     *
     * @return array
     */
    public function getSeparators(): array
    {
        return [
            0 => "",
            1 => "ratus",
            2 => "ribu",
            3 => "juta",
            4 => "bilion"
        ];
    }

    /**
     * Get currency names (Malaysian Ringgit)
     *
     * @return array
     */
    public function getCurrencyNames(): array
    {
        return [
            'currency' => 'ringgit',
            'subunit' => 'sen'
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
            'and' => 'dan',
            'minus' => 'negatif',
            'point' => 'titik'
        ];
    }

    /**
     * Get negative word
     *
     * @return string
     */
    public function getNegativeWord(): string
    {
        return 'negatif';
    }

    /**
     * Get zero word
     *
     * @return string
     */
    public function getZeroWord(): string
    {
        return 'kosong';
    }
}
