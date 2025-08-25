<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Manoar\SpellMoney\SpellMoney;

$spell = new SpellMoney();

echo "Testing New Languages:\n";
echo "=====================\n\n";

$languages = [
    'spanish' => 123.45,
    'russian' => 456.78,
    'japanese' => 789.12,
    'chinese' => 1000.50,
    'malaysian' => 250.75,
    'thai' => 888.25,
    'assamese' => 555.33
];

foreach ($languages as $language => $amount) {
    try {
        $result = $spell->setLanguage($language)->spell($amount);
        echo ucfirst($language) . ": $result\n";
    } catch (Exception $e) {
        echo ucfirst($language) . ": Error - " . $e->getMessage() . "\n";
    }
}

echo "\nTesting basic numbers:\n";
echo "=====================\n";

foreach (['spanish', 'russian', 'japanese', 'chinese'] as $language) {
    try {
        $one = $spell->setLanguage($language)->toWords(1);
        $ten = $spell->setLanguage($language)->toWords(10);
        $hundred = $spell->setLanguage($language)->toWords(100);
        echo ucfirst($language) . " - 1: $one, 10: $ten, 100: $hundred\n";
    } catch (Exception $e) {
        echo ucfirst($language) . ": Error - " . $e->getMessage() . "\n";
    }
}
