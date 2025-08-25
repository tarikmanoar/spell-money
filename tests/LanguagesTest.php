<?php

namespace Manoar\SpellMoney\Tests;

use PHPUnit\Framework\TestCase;
use Manoar\SpellMoney\Languages\English;
use Manoar\SpellMoney\Languages\Bengali;
use Manoar\SpellMoney\Languages\Hindi;
use Manoar\SpellMoney\Languages\Urdu;

class LanguagesTest extends TestCase
{
    public function testEnglishLanguage()
    {
        $english = new English();

        $basicNumbers = $english->getBasicNumbers();
        $this->assertEquals('one', $basicNumbers[1]);
        $this->assertEquals('twenty', $basicNumbers[20]);
        $this->assertEquals('ninety', $basicNumbers[90]);

        $separators = $english->getSeparators();
        $this->assertEquals('hundred', $separators[1]);
        $this->assertEquals('lakh', $separators[3]);
        $this->assertEquals('crore', $separators[4]);

        $currency = $english->getCurrencyNames();
        $this->assertEquals('taka', $currency['currency']);
        $this->assertEquals('paisa', $currency['subunit']);

        $this->assertEquals('minus', $english->getNegativeWord());
        $this->assertEquals('zero', $english->getZeroWord());
    }

    public function testBengaliLanguage()
    {
        $bengali = new Bengali();

        $basicNumbers = $bengali->getBasicNumbers();
        $this->assertEquals('এক', $basicNumbers[1]);
        $this->assertEquals('বিশ', $basicNumbers[20]);

        $separators = $bengali->getSeparators();
        $this->assertEquals('শত', $separators[1]);
        $this->assertEquals('লাখ', $separators[3]);
        $this->assertEquals('কোটি', $separators[4]);

        $currency = $bengali->getCurrencyNames();
        $this->assertEquals('টাকা', $currency['currency']);
        $this->assertEquals('পয়সা', $currency['subunit']);

        $this->assertEquals('বিয়োগ', $bengali->getNegativeWord());
        $this->assertEquals('শূন্য', $bengali->getZeroWord());
    }

    public function testHindiLanguage()
    {
        $hindi = new Hindi();

        $basicNumbers = $hindi->getBasicNumbers();
        $this->assertEquals('एक', $basicNumbers[1]);
        $this->assertEquals('बीस', $basicNumbers[20]);

        $separators = $hindi->getSeparators();
        $this->assertEquals('सौ', $separators[1]);
        $this->assertEquals('लाख', $separators[3]);
        $this->assertEquals('करोड़', $separators[4]);

        $currency = $hindi->getCurrencyNames();
        $this->assertEquals('रुपये', $currency['currency']);
        $this->assertEquals('पैसे', $currency['subunit']);

        $this->assertEquals('ऋण', $hindi->getNegativeWord());
        $this->assertEquals('शून्य', $hindi->getZeroWord());
    }

    public function testUrduLanguage()
    {
        $urdu = new Urdu();

        $basicNumbers = $urdu->getBasicNumbers();
        $this->assertEquals('ایک', $basicNumbers[1]);
        $this->assertEquals('بیس', $basicNumbers[20]);

        $separators = $urdu->getSeparators();
        $this->assertEquals('سو', $separators[1]);
        $this->assertEquals('لاکھ', $separators[3]);
        $this->assertEquals('کروڑ', $separators[4]);

        $currency = $urdu->getCurrencyNames();
        $this->assertEquals('روپے', $currency['currency']);
        $this->assertEquals('پیسے', $currency['subunit']);

        $this->assertEquals('منفی', $urdu->getNegativeWord());
        $this->assertEquals('صفر', $urdu->getZeroWord());
    }

    public function testInternationalSeparators()
    {
        $english = new English();
        $intlSeparators = $english->getInternationalSeparators();

        $this->assertEquals('thousand', $intlSeparators[2]);
        $this->assertEquals('million', $intlSeparators[3]);
        $this->assertEquals('billion', $intlSeparators[4]);
        $this->assertEquals('trillion', $intlSeparators[5]);
    }
}
