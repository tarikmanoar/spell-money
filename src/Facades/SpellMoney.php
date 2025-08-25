<?php

namespace Manoar\SpellMoney\Facades;

use Illuminate\Support\Facades\Facade;
use Manoar\SpellMoney\Contracts\SpellMoneyInterface;

/**
 * @method static string toWords(float|int $number, array $options = [])
 * @method static string toCurrency(float|int $number, array $options = [])
 * @method static string spell(float|int $number)
 * @method static self setLanguage(string $language)
 * @method static self setNumberSystem(string $system)
 * @method static self setCurrency(string $currency, string $subunit)
 * @method static self setCase(string $case)
 * @method static self setDecimalPrecision(int $precision)
 */
class SpellMoney extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return SpellMoneyInterface::class;
    }
}
