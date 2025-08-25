<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Manoar\SpellMoney\SpellMoney;

echo "=== Spell Money Package - Multi-Language Demo ===\n\n";

$amount = 1234.56;
$languages = [
    'english' => 'English',
    'bengali' => 'Bengali (বাংলা)',
    'hindi' => 'Hindi (हिन्दी)',
    'urdu' => 'Urdu (اردو)',
    'tamil' => 'Tamil (தமிழ்)',
    'telugu' => 'Telugu (తెలుగు)',
    'malayalam' => 'Malayalam (മലയാളം)',
    'kannada' => 'Kannada (ಕನ್ನಡ)',
    'gujarati' => 'Gujarati (ગુજરાતી)',
    'marathi' => 'Marathi (मराठी)',
    'punjabi' => 'Punjabi (ਪੰਜਾਬੀ)',
    'nepali' => 'Nepali (नेपाली)',
    'arabic' => 'Arabic (العربية)',
    'sinhala' => 'Sinhala (සිංහල)',
];

echo "Converting amount: $amount\n";
echo "=================================\n\n";

foreach ($languages as $languageCode => $languageName) {
    $spellMoney = new SpellMoney();

    $result = $spellMoney->setLanguage($languageCode)->toCurrency($amount);

    echo sprintf("%-25s: %s\n", $languageName, $result);
}

echo "\n=== Number System Comparison ===\n\n";
$largeAmount = 1500000;
echo "Amount: $largeAmount\n";
echo "--------------------\n\n";

// South Asian System
$spellMoney = new SpellMoney();
echo "South Asian (lakh-crore) system:\n";
foreach (['english', 'bengali', 'tamil', 'arabic'] as $lang) {
    $result = $spellMoney->setLanguage($lang)->setNumberSystem('south_asian')->toCurrency($largeAmount);
    echo "  $lang: $result\n";
}

echo "\nInternational (million-billion) system:\n";
foreach (['english', 'bengali', 'tamil', 'arabic'] as $lang) {
    $result = $spellMoney->setLanguage($lang)->setNumberSystem('international')->toCurrency($largeAmount);
    echo "  $lang: $result\n";
}

echo "\n=== Case Formatting Demo ===\n\n";
$testAmount = 250;
$spellMoney = new SpellMoney();

$cases = ['lower', 'title', 'sentence', 'upper'];
foreach ($cases as $case) {
    $result = $spellMoney->setLanguage('english')->setCase($case)->toCurrency($testAmount);
    echo sprintf("%-10s: %s\n", ucfirst($case), $result);
}

echo "\n=== Negative Numbers Demo ===\n\n";
$negativeAmount = -123.45;
foreach (['english', 'bengali', 'arabic'] as $lang) {
    $spellMoney = new SpellMoney();
    $result = $spellMoney->setLanguage($lang)->toCurrency($negativeAmount);
    echo "$lang: $result\n";
}

echo "\n=== Zero Values Demo ===\n\n";
foreach (['english', 'tamil', 'arabic'] as $lang) {
    $spellMoney = new SpellMoney();
    $result = $spellMoney->setLanguage($lang)->toCurrency(0);
    echo "$lang: $result\n";
}

echo "\n=== Decimal Precision Demo ===\n\n";
$precisionAmount = 100.789;
for ($precision = 0; $precision <= 2; $precision++) {
    $spellMoney = new SpellMoney();
    $result = $spellMoney->setDecimalPrecision($precision)->toCurrency($precisionAmount);
    echo "Precision $precision: $result\n";
}

echo "\nDemo completed successfully!\n";
