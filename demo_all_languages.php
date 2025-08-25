<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Manoar\SpellMoney\SpellMoney;

$spellMoney = new SpellMoney();
$amount = 1234.56;

echo "Comprehensive Multi-Language Demo\n";
echo "=================================\n\n";
echo "Converting: $amount\n\n";

$languages = [
    // South Asian Languages
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
    'sinhala' => 'Sinhala (සිංහල)',
    'assamese' => 'Assamese (অসমীয়া)',

    // Arabic Languages
    'arabic' => 'Arabic (العربية)',

    // European Languages
    'spanish' => 'Spanish (Español)',
    'russian' => 'Russian (Русский)',

    // East Asian Languages
    'japanese' => 'Japanese (日本語)',
    'chinese' => 'Chinese (中文)',

    // Southeast Asian Languages
    'malaysian' => 'Malaysian (Bahasa Malaysia)',
    'thai' => 'Thai (ไทย)'
];

foreach ($languages as $code => $name) {
    try {
        $result = $spellMoney->setLanguage($code)->toCurrency($amount);
        echo sprintf("%-30s: %s\n", $name, $result);
    } catch (Exception $e) {
        echo sprintf("%-30s: ERROR - %s\n", $name, $e->getMessage());
    }
}

echo "\n\nNumber System Comparison (1000000):\n";
echo "====================================\n";

echo "South Asian System:\n";
echo "English: " . $spellMoney->setLanguage('english')->setNumberSystem('south_asian')->toWords(1000000) . "\n";
echo "Bengali: " . $spellMoney->setLanguage('bengali')->setNumberSystem('south_asian')->toWords(1000000) . "\n";

echo "\nInternational System:\n";
echo "English: " . $spellMoney->setLanguage('english')->setNumberSystem('international')->toWords(1000000) . "\n";
echo "Spanish: " . $spellMoney->setLanguage('spanish')->setNumberSystem('international')->toWords(1000000) . "\n";
echo "Russian: " . $spellMoney->setLanguage('russian')->setNumberSystem('international')->toWords(1000000) . "\n";

echo "\nJapanese System:\n";
echo "Japanese: " . $spellMoney->setLanguage('japanese')->toWords(1000000) . "\n";
echo "Chinese: " . $spellMoney->setLanguage('chinese')->toWords(1000000) . "\n";

echo "\n\nCurrency Examples:\n";
echo "==================\n";
$currencies = [
    'english' => 'Taka',
    'spanish' => 'Peso',
    'russian' => 'Ruble',
    'japanese' => 'Yen',
    'chinese' => 'Yuan',
    'malaysian' => 'Ringgit',
    'thai' => 'Baht',
    'arabic' => 'Dirham'
];

foreach ($currencies as $lang => $currency) {
    $result = $spellMoney->setLanguage($lang)->toCurrency(100.50);
    echo sprintf("%-12s: %s\n", $currency, $result);
}
