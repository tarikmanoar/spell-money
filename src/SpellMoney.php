<?php

namespace Manoar\SpellMoney;

use Manoar\SpellMoney\Contracts\SpellMoneyInterface;
use Manoar\SpellMoney\Contracts\LanguageInterface;
use Manoar\SpellMoney\Languages\English;
use Manoar\SpellMoney\Languages\Bengali;
use Manoar\SpellMoney\Languages\Hindi;
use Manoar\SpellMoney\Languages\Urdu;
use Manoar\SpellMoney\Languages\Tamil;
use Manoar\SpellMoney\Languages\Telugu;
use Manoar\SpellMoney\Languages\Malayalam;
use Manoar\SpellMoney\Languages\Kannada;
use Manoar\SpellMoney\Languages\Gujarati;
use Manoar\SpellMoney\Languages\Marathi;
use Manoar\SpellMoney\Languages\Punjabi;
use Manoar\SpellMoney\Languages\Nepali;
use Manoar\SpellMoney\Languages\Arabic;
use Manoar\SpellMoney\Languages\Sinhala;
use Manoar\SpellMoney\Languages\Spanish;
use Manoar\SpellMoney\Languages\Russian;
use Manoar\SpellMoney\Languages\Japanese;
use Manoar\SpellMoney\Languages\Chinese;
use Manoar\SpellMoney\Languages\Malaysian;
use Manoar\SpellMoney\Languages\Thai;
use Manoar\SpellMoney\Languages\Assamese;

class SpellMoney implements SpellMoneyInterface
{
    protected LanguageInterface $language;
    protected string $numberSystem = 'south_asian';
    protected string $currency = 'taka';
    protected string $subunit = 'paisa';
    protected string $case = 'lower';
    protected int $decimalPrecision = 2;
    protected array $config;

    public function __construct(array $config = [])
    {
        $this->config = array_merge([
            'default_language' => 'english',
            'default_number_system' => 'south_asian',
            'default_case' => 'lower',
            'default_decimal_precision' => 2,
            'currencies' => [
                'english' => ['currency' => 'taka', 'subunit' => 'paisa'],
                'bengali' => ['currency' => 'টাকা', 'subunit' => 'পয়সা'],
                'hindi' => ['currency' => 'रुपये', 'subunit' => 'पैसे'],
                'urdu' => ['currency' => 'روپے', 'subunit' => 'پیسے'],
                'tamil' => ['currency' => 'ரூபாய்', 'subunit' => 'பைசா'],
                'telugu' => ['currency' => 'రూపాయి', 'subunit' => 'పైసా'],
                'malayalam' => ['currency' => 'രൂപ', 'subunit' => 'പൈസ'],
                'kannada' => ['currency' => 'ರೂಪಾಯಿ', 'subunit' => 'ಪೈಸೆ'],
                'gujarati' => ['currency' => 'રૂપિયા', 'subunit' => 'પૈસા'],
                'marathi' => ['currency' => 'रुपया', 'subunit' => 'पैसा'],
                'punjabi' => ['currency' => 'ਰੁਪਈਆ', 'subunit' => 'ਪੈਸਾ'],
                'nepali' => ['currency' => 'रुपैयाँ', 'subunit' => 'पैसा'],
                'arabic' => ['currency' => 'درهم', 'subunit' => 'فلس'],
                'sinhala' => ['currency' => 'රුපියල', 'subunit' => 'සත'],
                'spanish' => ['currency' => 'peso', 'subunit' => 'centavo'],
                'russian' => ['currency' => 'рубль', 'subunit' => 'копейка'],
                'japanese' => ['currency' => '円', 'subunit' => '銭'],
                'chinese' => ['currency' => '元', 'subunit' => '角'],
                'malaysian' => ['currency' => 'ringgit', 'subunit' => 'sen'],
                'thai' => ['currency' => 'บาท', 'subunit' => 'สตางค์'],
                'assamese' => ['currency' => 'টকা', 'subunit' => 'পইচা'],
            ]
        ], $config);

        $this->language = new English();
        $this->numberSystem = $this->config['default_number_system'];
        $this->case = $this->config['default_case'];
        $this->decimalPrecision = $this->config['default_decimal_precision'];

        $currencyConfig = $this->config['currencies'][$this->config['default_language']] ?? $this->config['currencies']['english'];
        $this->currency = $currencyConfig['currency'];
        $this->subunit = $currencyConfig['subunit'];
    }

    /**
     * Convert a number to words
     *
     * @param float|int $number
     * @param array $options
     * @return string
     */
    public function toWords($number, array $options = []): string
    {
        $isNegative = $number < 0;
        $number = abs($number);

        if ($number == 0) {
            return $this->formatCase($this->language->getZeroWord());
        }

        $words = $this->convertNumberToWords($number);

        if ($isNegative) {
            $words = $this->language->getNegativeWord() . ' ' . $words;
        }

        return $this->formatCase($words);
    }

    /**
     * Convert a number to currency words
     *
     * @param float|int $number
     * @param array $options
     * @return string
     */
    public function toCurrency($number, array $options = []): string
    {
        $isNegative = $number < 0;
        $number = abs($number);

        $integerPart = (int) $number;

        // Handle decimal precision
        $multiplier = pow(10, $this->decimalPrecision);
        $decimalPart = 0;
        if ($this->decimalPrecision > 0) {
            $decimalPart = round(($number - $integerPart) * $multiplier);
        }

        $words = '';

        if ($integerPart > 0) {
            $words = $this->convertNumberToWords($integerPart) . ' ' . $this->currency;
        } else {
            $words = $this->language->getZeroWord() . ' ' . $this->currency;
        }

        if ($decimalPart > 0 && $this->decimalPrecision > 0) {
            $decimalWords = $this->convertNumberToWords($decimalPart);
            if ($integerPart > 0) {
                $connectors = $this->language->getConnectors();
                $words .= ' ' . $connectors['and'] . ' ' . $decimalWords . ' ' . $this->subunit;
            } else {
                $words = $decimalWords . ' ' . $this->subunit;
            }
        }

        if ($isNegative) {
            $words = $this->language->getNegativeWord() . ' ' . $words;
        }

        return $this->formatCase($words);
    }

    /**
     * Legacy method for backward compatibility
     *
     * @param float|int $number
     * @return string
     */
    public function spell($number): string
    {
        return $this->toCurrency($number);
    }

    /**
     * Set the language for conversion
     *
     * @param string $language
     * @return self
     */
    public function setLanguage(string $language): self
    {
        $this->language = match ($language) {
            'bengali' => new Bengali(),
            'hindi' => new Hindi(),
            'urdu' => new Urdu(),
            'tamil' => new Tamil(),
            'telugu' => new Telugu(),
            'malayalam' => new Malayalam(),
            'kannada' => new Kannada(),
            'gujarati' => new Gujarati(),
            'marathi' => new Marathi(),
            'punjabi' => new Punjabi(),
            'nepali' => new Nepali(),
            'arabic' => new Arabic(),
            'sinhala' => new Sinhala(),
            'spanish' => new Spanish(),
            'russian' => new Russian(),
            'japanese' => new Japanese(),
            'chinese' => new Chinese(),
            'malaysian' => new Malaysian(),
            'thai' => new Thai(),
            'assamese' => new Assamese(),
            default => new English(),
        };

        // Update currency based on language
        $currencyConfig = $this->config['currencies'][$language] ?? $this->config['currencies']['english'];
        $this->currency = $currencyConfig['currency'];
        $this->subunit = $currencyConfig['subunit'];

        return $this;
    }

    /**
     * Set the number system (south_asian or international)
     *
     * @param string $system
     * @return self
     */
    public function setNumberSystem(string $system): self
    {
        $this->numberSystem = in_array($system, ['south_asian', 'international']) ? $system : 'south_asian';
        return $this;
    }

    /**
     * Set currency options
     *
     * @param string $currency
     * @param string $subunit
     * @return self
     */
    public function setCurrency(string $currency, string $subunit): self
    {
        $this->currency = $currency;
        $this->subunit = $subunit;
        return $this;
    }

    /**
     * Set case formatting
     *
     * @param string $case
     * @return self
     */
    public function setCase(string $case): self
    {
        $this->case = in_array($case, ['title', 'sentence', 'lower', 'upper']) ? $case : 'lower';
        return $this;
    }

    /**
     * Set decimal precision
     *
     * @param int $precision
     * @return self
     */
    public function setDecimalPrecision(int $precision): self
    {
        $this->decimalPrecision = max(0, min(2, $precision));
        return $this;
    }

    /**
     * Convert number to words based on number system
     *
     * @param float $number
     * @return string
     */
    protected function convertNumberToWords(float $number): string
    {
        if ($this->numberSystem === 'international') {
            return $this->convertInternationalSystem($number);
        }

        return $this->convertSouthAsianSystem($number);
    }

    /**
     * Convert number using South Asian system (lakh-crore)
     *
     * @param float $number
     * @return string
     */
    protected function convertSouthAsianSystem(float $number): string
    {
        $integerPart = (int) $number;
        $integerStr = (string) $integerPart;

        if ($integerPart == 0) {
            return $this->language->getZeroWord();
        }

        $len = strlen($integerStr);
        $integerStr = strrev($integerStr);
        $inWords = '';

        for ($i = 0; $i < $len; $i += 7) {
            $part = substr($integerStr, $i, 7);
            $level = $this->calculateLevel(strlen($part));
            $odd = (strlen($part) == 4 || strlen($part) == 6);
            $partWords = $this->convertSevenDigitPart(strrev($part), $level, 0, $odd);

            if ($i >= 7) {
                $partWords = str_replace(' ' . $this->language->getConnectors()['and'], '', $partWords);
                $separators = $this->language->getSeparators();
                $inWords = trim($partWords) . ' ' . $separators[4] . ' ' . $inWords;
            } else {
                $inWords = trim($partWords) . ' ' . $inWords;
            }
        }

        return trim($inWords);
    }

    /**
     * Convert number using International system (million-billion)
     *
     * @param float $number
     * @return string
     */
    protected function convertInternationalSystem(float $number): string
    {
        $integerPart = (int) $number;

        if ($integerPart == 0) {
            return $this->language->getZeroWord();
        }

        // Get international separators from the language class
        if (method_exists($this->language, 'getInternationalSeparators')) {
            $separators = $this->language->getInternationalSeparators();
        } else {
            // Fallback to base international separators
            $separators = [
                0 => "",
                1 => "hundred",
                2 => "thousand",
                3 => "million",
                4 => "billion",
                5 => "trillion"
            ];
        }

        $words = '';
        $scale = 0;

        while ($integerPart > 0) {
            $group = $integerPart % 1000;

            if ($group > 0) {
                $groupWords = $this->convertThreeDigitGroup($group);

                // Add scale name if scale > 0
                if ($scale == 1 && isset($separators[2])) {
                    // Thousand
                    $groupWords .= ' ' . $separators[2];
                } elseif ($scale == 2 && isset($separators[3])) {
                    // Million
                    $groupWords .= ' ' . $separators[3];
                } elseif ($scale == 3 && isset($separators[4])) {
                    // Billion
                    $groupWords .= ' ' . $separators[4];
                } elseif ($scale == 4 && isset($separators[5])) {
                    // Trillion
                    $groupWords .= ' ' . $separators[5];
                }

                if ($words) {
                    $words = $groupWords . ' ' . $words;
                } else {
                    $words = $groupWords;
                }
            }

            $integerPart = (int) ($integerPart / 1000);
            $scale++;
        }

        return trim($words);
    }

    /**
     * Convert a three-digit group to words
     *
     * @param int $number
     * @return string
     */
    protected function convertThreeDigitGroup(int $number): string
    {
        $basicNumbers = $this->language->getBasicNumbers();
        $separators = $this->language->getSeparators();
        $words = '';

        // Hundreds
        $hundreds = (int) ($number / 100);
        if ($hundreds > 0) {
            $words .= $basicNumbers[$hundreds] . ' ' . $separators[1];
        }

        // Tens and units
        $remainder = $number % 100;
        if ($remainder > 0) {
            if ($words && $remainder < 100) {
                $words .= ' ';
            }

            if (isset($basicNumbers[$remainder])) {
                $words .= $basicNumbers[$remainder];
            } else {
                $tens = (int) ($remainder / 10) * 10;
                $units = $remainder % 10;
                if ($tens > 0) {
                    $words .= $basicNumbers[$tens];
                    if ($units > 0) {
                        $words .= ' ' . $basicNumbers[$units];
                    }
                } else {
                    $words .= $basicNumbers[$units];
                }
            }
        }

        return trim($words);
    }

    /**
     * Recursive function to convert a seven-digit segment to words
     */
    protected function convertSevenDigitPart(string $segment, int $level, int $index, bool $odd): string
    {
        $separators = $this->language->getSeparators();
        $str = substr($segment, $index, $odd || $level == 1 ? 1 : 2);
        $increment = strlen($str);
        $words = $this->convertToWords($str);

        if ($level > 0) {
            if (intval($str) > 0) {
                $words .= ' ' . $separators[$level] . ' ';
            }
            return $words . $this->convertSevenDigitPart($segment, $level - 1, $index + $increment, false);
        }

        $connectors = $this->language->getConnectors();
        if (intval($str) > 0 && strlen($segment) > 2) {
            return $connectors['and'] . ' ' . $words;
        } else {
            return ' ' . $words;
        }
    }

    /**
     * Converts a number string to words
     */
    protected function convertToWords(string $numStr): string
    {
        $integer = intval($numStr);
        if ($integer == 0) return '';

        $basicNumbers = $this->language->getBasicNumbers();

        if (array_key_exists($integer, $basicNumbers)) {
            return $basicNumbers[$integer];
        }

        $tens = intval($integer / 10) * 10;
        $units = $integer % 10;

        return $basicNumbers[$tens] . ' ' . $basicNumbers[$units];
    }

    /**
     * Calculates the place value level
     */
    protected function calculateLevel(int $len): int
    {
        if ($len <= 2) return 0;
        if ($len == 3) return 1;
        if ($len <= 5) return 2;
        if ($len <= 7) return 3;
        return 4;
    }

    /**
     * Format text case
     *
     * @param string $text
     * @return string
     */
    protected function formatCase(string $text): string
    {
        return match ($this->case) {
            'title' => ucwords($text),
            'sentence' => ucfirst($text),
            'upper' => strtoupper($text),
            default => strtolower($text),
        };
    }
}
