<?php

namespace Manoar\SpellMoney\Tests;

use Manoar\SpellMoney\SpellMoney;
use PHPUnit\Framework\TestCase;

class NewLanguagesTest extends TestCase
{
    /**
     * Test Tamil language
     */
    public function testTamilLanguage()
    {
        $spellMoney = new SpellMoney();
        $spellMoney->setLanguage('tamil');

        $this->assertEquals('ஒன்று ரூபாய்', $spellMoney->toCurrency(1));
        $this->assertEquals('பத்து ரூபாய்', $spellMoney->toCurrency(10));
        $this->assertEquals('ஒன்று நூறு ரூபாய்', $spellMoney->toCurrency(100));
        $this->assertEquals('ஒன்று ஆயிரம் ரூபாய்', $spellMoney->toCurrency(1000));
    }

    /**
     * Test Telugu language
     */
    public function testTeluguLanguage()
    {
        $spellMoney = new SpellMoney();
        $spellMoney->setLanguage('telugu');

        $this->assertEquals('ఒకటి రూపాయి', $spellMoney->toCurrency(1));
        $this->assertEquals('పది రూపాయి', $spellMoney->toCurrency(10));
        $this->assertEquals('ఒకటి వందలు రూపాయి', $spellMoney->toCurrency(100));
        $this->assertEquals('ఒకటి వేలు రూపాయి', $spellMoney->toCurrency(1000));
    }

    /**
     * Test Malayalam language
     */
    public function testMalayalamLanguage()
    {
        $spellMoney = new SpellMoney();
        $spellMoney->setLanguage('malayalam');

        $this->assertEquals('ഒന്ന് രൂപ', $spellMoney->toCurrency(1));
        $this->assertEquals('പത്ത് രൂപ', $spellMoney->toCurrency(10));
        $this->assertEquals('ഒന്ന് നൂറ് രൂപ', $spellMoney->toCurrency(100));
        $this->assertEquals('ഒന്ന് ആയിരം രൂപ', $spellMoney->toCurrency(1000));
    }

    /**
     * Test Kannada language
     */
    public function testKannadaLanguage()
    {
        $spellMoney = new SpellMoney();
        $spellMoney->setLanguage('kannada');

        $this->assertEquals('ಒಂದು ರೂಪಾಯಿ', $spellMoney->toCurrency(1));
        $this->assertEquals('ಹತ್ತು ರೂಪಾಯಿ', $spellMoney->toCurrency(10));
        $this->assertEquals('ಒಂದು ನೂರು ರೂಪಾಯಿ', $spellMoney->toCurrency(100));
        $this->assertEquals('ಒಂದು ಸಾವಿರ ರೂಪಾಯಿ', $spellMoney->toCurrency(1000));
    }

    /**
     * Test Gujarati language
     */
    public function testGujaratiLanguage()
    {
        $spellMoney = new SpellMoney();
        $spellMoney->setLanguage('gujarati');

        $this->assertEquals('એક રૂપિયા', $spellMoney->toCurrency(1));
        $this->assertEquals('દસ રૂપિયા', $spellMoney->toCurrency(10));
        $this->assertEquals('એક સો રૂપિયા', $spellMoney->toCurrency(100));
        $this->assertEquals('એક હજાર રૂપિયા', $spellMoney->toCurrency(1000));
    }

    /**
     * Test Marathi language
     */
    public function testMarathiLanguage()
    {
        $spellMoney = new SpellMoney();
        $spellMoney->setLanguage('marathi');

        $this->assertEquals('एक रुपया', $spellMoney->toCurrency(1));
        $this->assertEquals('दहा रुपया', $spellMoney->toCurrency(10));
        $this->assertEquals('एक शंभर रुपया', $spellMoney->toCurrency(100));
        $this->assertEquals('एक हजार रुपया', $spellMoney->toCurrency(1000));
    }

    /**
     * Test Punjabi language
     */
    public function testPunjabiLanguage()
    {
        $spellMoney = new SpellMoney();
        $spellMoney->setLanguage('punjabi');

        $this->assertEquals('ਇਕ ਰੁਪਈਆ', $spellMoney->toCurrency(1));
        $this->assertEquals('ਦਸ ਰੁਪਈਆ', $spellMoney->toCurrency(10));
        $this->assertEquals('ਇਕ ਸੌ ਰੁਪਈਆ', $spellMoney->toCurrency(100));
        $this->assertEquals('ਇਕ ਹਜ਼ਾਰ ਰੁਪਈਆ', $spellMoney->toCurrency(1000));
    }

    /**
     * Test Nepali language
     */
    public function testNepaliLanguage()
    {
        $spellMoney = new SpellMoney();
        $spellMoney->setLanguage('nepali');

        $this->assertEquals('एक रुपैयाँ', $spellMoney->toCurrency(1));
        $this->assertEquals('दश रुपैयाँ', $spellMoney->toCurrency(10));
        $this->assertEquals('एक सय रुपैयाँ', $spellMoney->toCurrency(100));
        $this->assertEquals('एक हजार रुपैयाँ', $spellMoney->toCurrency(1000));
    }

    /**
     * Test Arabic language
     */
    public function testArabicLanguage()
    {
        $spellMoney = new SpellMoney();
        $spellMoney->setLanguage('arabic');

        $this->assertEquals('واحد درهم', $spellMoney->toCurrency(1));
        $this->assertEquals('عشرة درهم', $spellMoney->toCurrency(10));
        $this->assertEquals('واحد مئة درهم', $spellMoney->toCurrency(100));
        $this->assertEquals('واحد ألف درهم', $spellMoney->toCurrency(1000));
    }

    /**
     * Test Sinhala language
     */
    public function testSinhalaLanguage()
    {
        $spellMoney = new SpellMoney();
        $spellMoney->setLanguage('sinhala');

        $this->assertEquals('එක රුපියල', $spellMoney->toCurrency(1));
        $this->assertEquals('දහය රුපියල', $spellMoney->toCurrency(10));
        $this->assertEquals('එක සිය රුපියල', $spellMoney->toCurrency(100));
        $this->assertEquals('එක දහස රුපියල', $spellMoney->toCurrency(1000));
    }

    /**
     * Test all languages with international number system
     */
    public function testInternationalSystemWithNewLanguages()
    {
        $spellMoney = new SpellMoney();
        $number = 1000000;

        $spellMoney->setLanguage('tamil')->setNumberSystem('international');
        $this->assertStringContainsString('மில்லியன்', $spellMoney->toCurrency($number));

        $spellMoney->setLanguage('arabic')->setNumberSystem('international');
        $this->assertStringContainsString('مليون', $spellMoney->toCurrency($number));

        $spellMoney->setLanguage('nepali')->setNumberSystem('international');
        $this->assertStringContainsString('मिलियन', $spellMoney->toCurrency($number));
    }

    /**
     * Test decimal values with new languages
     */
    public function testDecimalsWithNewLanguages()
    {
        $spellMoney = new SpellMoney();

        $spellMoney->setLanguage('tamil');
        $result = $spellMoney->toCurrency(1.50);
        $this->assertStringContainsString('ஒன்று ரூபாய்', $result);
        $this->assertStringContainsString('பைசா', $result);

        $spellMoney->setLanguage('arabic');
        $result = $spellMoney->toCurrency(1.75);
        $this->assertStringContainsString('واحد درهم', $result);
        $this->assertStringContainsString('فلس', $result);
    }

    /**
     * Test negative numbers with new languages
     */
    public function testNegativeNumbersWithNewLanguages()
    {
        $spellMoney = new SpellMoney();

        $spellMoney->setLanguage('gujarati');
        $result = $spellMoney->toCurrency(-100);
        $this->assertStringStartsWith('માઇનસ', $result);

        $spellMoney->setLanguage('malayalam');
        $result = $spellMoney->toCurrency(-50);
        $this->assertStringStartsWith('മൈനസ്', $result);
    }

    /**
     * Test zero values with new languages
     */
    public function testZeroWithNewLanguages()
    {
        $spellMoney = new SpellMoney();

        $spellMoney->setLanguage('kannada');
        $this->assertEquals('ಸೊನ್ನೆ ರೂಪಾಯಿ', $spellMoney->toCurrency(0));

        $spellMoney->setLanguage('punjabi');
        $this->assertEquals('ਸਿਫਰ ਰੁਪਈਆ', $spellMoney->toCurrency(0));

        $spellMoney->setLanguage('sinhala');
        $this->assertEquals('බින්දුව රුපියල', $spellMoney->toCurrency(0));
    }

    /**
     * Test case formatting with new languages
     */
    public function testCaseFormattingWithNewLanguages()
    {
        $spellMoney = new SpellMoney();

        $spellMoney->setLanguage('marathi')->setCase('upper');
        $result = $spellMoney->toCurrency(100);
        $this->assertEquals(mb_strtoupper('एक शंभर रुपया', 'UTF-8'), $result);

        $spellMoney->setLanguage('telugu')->setCase('title');
        $result = $spellMoney->toCurrency(50);
        $this->assertTrue(mb_strlen($result) > 0);
    }
}
