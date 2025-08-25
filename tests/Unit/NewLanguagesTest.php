<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Manoar\SpellMoney\SpellMoney;

class NewLanguagesTest extends TestCase
{
    protected SpellMoney $spellMoney;

    protected function setUp(): void
    {
        parent::setUp();
        $this->spellMoney = new SpellMoney();
    }

    /** @test */
    public function it_can_spell_numbers_in_spanish()
    {
        $result = $this->spellMoney->setLanguage('spanish')->spell(123.45);
        $this->assertIsString($result);
        $this->assertStringContainsString('peso', $result);
    }

    /** @test */
    public function it_can_spell_numbers_in_russian()
    {
        $result = $this->spellMoney->setLanguage('russian')->spell(456.78);
        $this->assertIsString($result);
        $this->assertStringContainsString('рубль', $result);
    }

    /** @test */
    public function it_can_spell_numbers_in_japanese()
    {
        $result = $this->spellMoney->setLanguage('japanese')->spell(789.12);
        $this->assertIsString($result);
        $this->assertStringContainsString('円', $result);
    }

    /** @test */
    public function it_can_spell_numbers_in_chinese()
    {
        $result = $this->spellMoney->setLanguage('chinese')->spell(1000.50);
        $this->assertIsString($result);
        $this->assertStringContainsString('元', $result);
    }

    /** @test */
    public function it_can_spell_numbers_in_malaysian()
    {
        $result = $this->spellMoney->setLanguage('malaysian')->spell(250.75);
        $this->assertIsString($result);
        $this->assertStringContainsString('ringgit', $result);
    }

    /** @test */
    public function it_can_spell_numbers_in_thai()
    {
        $result = $this->spellMoney->setLanguage('thai')->spell(888.25);
        $this->assertIsString($result);
        $this->assertStringContainsString('บาท', $result);
    }

    /** @test */
    public function it_can_spell_numbers_in_assamese()
    {
        $result = $this->spellMoney->setLanguage('assamese')->spell(555.33);
        $this->assertIsString($result);
        $this->assertStringContainsString('টকা', $result);
    }

    /** @test */
    public function it_can_handle_all_new_languages()
    {
        $languages = ['spanish', 'russian', 'japanese', 'chinese', 'malaysian', 'thai', 'assamese'];
        $amount = 100.50;

        foreach ($languages as $language) {
            $result = $this->spellMoney->setLanguage($language)->spell($amount);
            $this->assertIsString($result);
            $this->assertNotEmpty($result);
        }
    }

    /** @test */
    public function it_can_spell_zero_in_all_new_languages()
    {
        $languages = [
            'spanish' => 'cero',
            'russian' => 'ноль',
            'japanese' => '零',
            'chinese' => '零',
            'malaysian' => 'kosong',
            'thai' => 'ศูนย์',
            'assamese' => 'শূন্য'
        ];

        foreach ($languages as $language => $expectedZero) {
            $result = $this->spellMoney->setLanguage($language)->toWords(0);
            $this->assertStringContainsString($expectedZero, $result);
        }
    }

    /** @test */
    public function it_can_spell_basic_numbers_in_new_languages()
    {
        // Test basic number spelling
        $testCases = [
            'spanish' => [1 => 'uno', 10 => 'diez', 100 => 'cien'],
            'russian' => [1 => 'один', 10 => 'десять', 100 => 'сто'],
            'japanese' => [1 => '一', 10 => '十', 100 => '百'],
            'chinese' => [1 => '一', 10 => '十', 100 => '百'],
            'malaysian' => [1 => 'satu', 10 => 'sepuluh', 100 => 'ratus'],
            'thai' => [1 => 'หนึ่ง', 10 => 'สิบ', 100 => 'ร้อย'],
            'assamese' => [1 => 'এক', 10 => 'দহ', 100 => 'শ']
        ];

        foreach ($testCases as $language => $numbers) {
            foreach ($numbers as $number => $expected) {
                $result = $this->spellMoney->setLanguage($language)->toWords($number);
                $this->assertStringContainsString($expected, $result);
            }
        }
    }
}
