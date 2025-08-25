<?php

namespace Manoar\SpellMoney\Tests;

use PHPUnit\Framework\TestCase;
use Manoar\SpellMoney\SpellMoney;

class SpellMoneyTest extends TestCase
{
    protected SpellMoney $spellMoney;

    protected function setUp(): void
    {
        $this->spellMoney = new SpellMoney();
    }

    public function testCanSpellBasicNumbers()
    {
        $this->assertEquals('one', $this->spellMoney->toWords(1));
        $this->assertEquals('twenty five', $this->spellMoney->toWords(25));
        $this->assertEquals('one hundred', $this->spellMoney->toWords(100));
        $this->assertEquals('zero', $this->spellMoney->toWords(0));
    }

    public function testCanSpellLakhCroreSystem()
    {
        $this->assertEquals('one thousand', $this->spellMoney->toWords(1000));
        $this->assertEquals('one lakh', $this->spellMoney->toWords(100000));
        $this->assertEquals('one crore', $this->spellMoney->toWords(10000000));
    }

    public function testCanSpellCurrency()
    {
        $result = $this->spellMoney->toCurrency(10000000);
        $this->assertEquals('one crore taka', $result);

        $result = $this->spellMoney->toCurrency(100000);
        $this->assertEquals('one lakh taka', $result);

        $result = $this->spellMoney->toCurrency(1);
        $this->assertEquals('one taka', $result);

        $result = $this->spellMoney->toCurrency(0);
        $this->assertEquals('zero taka', $result);
    }

    public function testCanSpellCurrencyWithPaisa()
    {
        $result = $this->spellMoney->toCurrency(0.25);
        $this->assertEquals('twenty five paisa', $result);

        $result = $this->spellMoney->toCurrency(1.25);
        $this->assertEquals('one taka and twenty five paisa', $result);

        $result = $this->spellMoney->toCurrency(125.75);
        $this->assertEquals('one hundred and twenty five taka and seventy five paisa', $result);
    }

    public function testCanHandleNegativeNumbers()
    {
        $result = $this->spellMoney->toWords(-100);
        $this->assertEquals('minus one hundred', $result);

        $result = $this->spellMoney->toCurrency(-25.50);
        $this->assertEquals('minus twenty five taka and fifty paisa', $result);
    }

    public function testCanSetLanguage()
    {
        $this->spellMoney->setLanguage('bengali');
        $result = $this->spellMoney->toWords(1);
        $this->assertEquals('এক', $result);

        $result = $this->spellMoney->toCurrency(100);
        $this->assertEquals('এক শত টাকা', $result);
    }

    public function testCanSetCase()
    {
        $this->spellMoney->setCase('title');
        $result = $this->spellMoney->toWords(25);
        $this->assertEquals('Twenty Five', $result);

        $this->spellMoney->setCase('sentence');
        $result = $this->spellMoney->toWords(25);
        $this->assertEquals('Twenty five', $result);

        $this->spellMoney->setCase('upper');
        $result = $this->spellMoney->toWords(25);
        $this->assertEquals('TWENTY FIVE', $result);
    }

    public function testCanSetNumberSystem()
    {
        $this->spellMoney->setNumberSystem('international');
        $result = $this->spellMoney->toWords(1000000);
        $this->assertEquals('one million', $result);

        $this->spellMoney->setNumberSystem('south_asian');
        $result = $this->spellMoney->toWords(1000000);
        $this->assertEquals('ten lakh', $result);
    }

    public function testCanSetCustomCurrency()
    {
        $this->spellMoney->setCurrency('dollar', 'cent');
        $result = $this->spellMoney->toCurrency(100.50);
        $this->assertEquals('one hundred dollar and fifty cent', $result);
    }

    public function testBackwardCompatibilityWithSpellMethod()
    {
        $result = $this->spellMoney->spell(4586);
        $this->assertStringContainsString('four thousand five hundred', $result);
        $this->assertStringContainsString('taka', $result);

        $result = $this->spellMoney->spell(25.85);
        $this->assertStringContainsString('twenty five taka', $result);
        $this->assertStringContainsString('eighty five paisa', $result);
    }

    public function testCanSpellBigValues()
    {
        $result = $this->spellMoney->spell(4582456225.54);
        $this->assertStringContainsString('four hundred fifty eight crore', $result);
        $this->assertStringContainsString('fifty four paisa', $result);
    }

    public function testMethodChaining()
    {
        $result = $this->spellMoney
            ->setLanguage('english')
            ->setCase('title')
            ->setCurrency('rupee', 'paise')
            ->toCurrency(150.25);

        $this->assertEquals('One Hundred And Fifty Rupee And Twenty Five Paise', $result);
    }

    public function testHindiLanguage()
    {
        $this->spellMoney->setLanguage('hindi');
        $result = $this->spellMoney->toWords(1);
        $this->assertEquals('एक', $result);

        $result = $this->spellMoney->toCurrency(100);
        $this->assertEquals('एक सौ रुपये', $result);
    }

    public function testUrduLanguage()
    {
        $this->spellMoney->setLanguage('urdu');
        $result = $this->spellMoney->toWords(1);
        $this->assertEquals('ایک', $result);

        $result = $this->spellMoney->toCurrency(100);
        $this->assertEquals('ایک سو روپے', $result);
    }

    public function testDecimalPrecision()
    {
        $this->spellMoney->setDecimalPrecision(1);
        $result = $this->spellMoney->toCurrency(100.567);
        // Should round to 1 decimal place (100.6, which becomes 6 paisa)
        $this->assertStringContainsString('six paisa', $result);

        $this->spellMoney->setDecimalPrecision(0);
        $result = $this->spellMoney->toCurrency(100.99);
        // Should not include paisa
        $this->assertEquals('one hundred taka', $result);
    }

    public function testEdgeCases()
    {
        // Very large numbers
        $result = $this->spellMoney->toWords(99999999);
        $this->assertStringContainsString('nine crore ninety nine lakh ninety nine thousand nine hundred and ninety nine', $result);

        // Zero decimal
        $result = $this->spellMoney->toCurrency(100.00);
        $this->assertEquals('one hundred taka', $result);

        // Small decimals
        $result = $this->spellMoney->toCurrency(0.01);
        $this->assertEquals('one paisa', $result);
    }
}
