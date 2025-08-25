<?php

/**
 * Example usage of the Spell Money package
 *
 * This file demonstrates various features and use cases
 */

require_once 'vendor/autoload.php';

use Manoar\SpellMoney\SpellMoney;

echo "=== Spell Money Package Examples ===\n\n";

// Initialize the SpellMoney instance
$spellMoney = new SpellMoney();

echo "1. Basic Number to Words Conversion:\n";
echo "100 => " . $spellMoney->toWords(100) . "\n";
echo "1234 => " . $spellMoney->toWords(1234) . "\n";
echo "100000 => " . $spellMoney->toWords(100000) . "\n";
echo "10000000 => " . $spellMoney->toWords(10000000) . "\n\n";

echo "2. Currency Conversion:\n";
echo "100.50 => " . $spellMoney->toCurrency(100.50) . "\n";
echo "1234.56 => " . $spellMoney->toCurrency(1234.56) . "\n";
echo "0.25 => " . $spellMoney->toCurrency(0.25) . "\n\n";

echo "3. Negative Numbers:\n";
echo "-100 => " . $spellMoney->toWords(-100) . "\n";
echo "-1234.56 => " . $spellMoney->toCurrency(-1234.56) . "\n\n";

echo "4. Different Languages:\n";
$spellMoney->setLanguage('bengali');
echo "Bengali - 1234 => " . $spellMoney->toWords(1234) . "\n";
echo "Bengali - 100.50 => " . $spellMoney->toCurrency(100.50) . "\n\n";

$spellMoney->setLanguage('hindi');
echo "Hindi - 1234 => " . $spellMoney->toWords(1234) . "\n";
echo "Hindi - 100.50 => " . $spellMoney->toCurrency(100.50) . "\n\n";

$spellMoney->setLanguage('urdu');
echo "Urdu - 1234 => " . $spellMoney->toWords(1234) . "\n";
echo "Urdu - 100.50 => " . $spellMoney->toCurrency(100.50) . "\n\n";

// Reset to English for remaining examples
$spellMoney->setLanguage('english');

echo "5. Case Formatting:\n";
$spellMoney->setCase('lower');
echo "Lower: " . $spellMoney->toWords(1234) . "\n";

$spellMoney->setCase('title');
echo "Title: " . $spellMoney->toWords(1234) . "\n";

$spellMoney->setCase('sentence');
echo "Sentence: " . $spellMoney->toWords(1234) . "\n";

$spellMoney->setCase('upper');
echo "Upper: " . $spellMoney->toWords(1234) . "\n\n";

// Reset case for remaining examples
$spellMoney->setCase('lower');

echo "6. Number Systems:\n";
$largeNumber = 2500000;

$spellMoney->setNumberSystem('south_asian');
echo "South Asian - {$largeNumber} => " . $spellMoney->toWords($largeNumber) . "\n";

$spellMoney->setNumberSystem('international');
echo "International - {$largeNumber} => " . $spellMoney->toWords($largeNumber) . "\n\n";

// Reset to South Asian for remaining examples
$spellMoney->setNumberSystem('south_asian');

echo "7. Custom Currency:\n";
$spellMoney->setCurrency('dollar', 'cent');
echo "Custom Currency - 150.75 => " . $spellMoney->toCurrency(150.75) . "\n";

$spellMoney->setCurrency('euro', 'cent');
echo "Euro - 250.30 => " . $spellMoney->toCurrency(250.30) . "\n\n";

echo "8. Method Chaining:\n";
$result = $spellMoney->setLanguage('english')
    ->setCase('title')
    ->setCurrency('rupee', 'paise')
    ->toCurrency(1575.25);
echo "Chained methods - 1575.25 => {$result}\n\n";

echo "9. Edge Cases:\n";
echo "Zero: " . $spellMoney->toWords(0) . "\n";
echo "Large number: " . $spellMoney->toWords(99999999) . "\n";
echo "Small decimal: " . $spellMoney->toCurrency(0.01) . "\n";
echo "No decimal: " . $spellMoney->toCurrency(100.00) . "\n\n";

echo "10. Backward Compatibility:\n";
$spellMoney->setCurrency('taka', 'paisa');
echo "Spell method - 4586.75 => " . $spellMoney->spell(4586.75) . "\n";
echo "Big value - 8752154836.52 => " . $spellMoney->spell(8752154836.52) . "\n\n";

echo "=== Examples Complete ===\n";
