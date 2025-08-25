<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Language
    |--------------------------------------------------------------------------
    |
    | This option controls the default language for number to words conversion.
    | Supported: 'english', 'bengali', 'hindi', 'urdu'
    |
    */
    'default_language' => env('SPELL_MONEY_LANGUAGE', 'english'),

    /*
    |--------------------------------------------------------------------------
    | Default Number System
    |--------------------------------------------------------------------------
    |
    | This option controls the default number system.
    | Supported: 'south_asian' (lakh-crore), 'international' (million-billion)
    |
    */
    'default_number_system' => env('SPELL_MONEY_NUMBER_SYSTEM', 'south_asian'),

    /*
    |--------------------------------------------------------------------------
    | Default Case Formatting
    |--------------------------------------------------------------------------
    |
    | This option controls the default case formatting for output.
    | Supported: 'title', 'sentence', 'lower', 'upper'
    |
    */
    'default_case' => env('SPELL_MONEY_CASE', 'lower'),

    /*
    |--------------------------------------------------------------------------
    | Default Decimal Precision
    |--------------------------------------------------------------------------
    |
    | This option controls the default decimal precision (0-2).
    |
    */
    'default_decimal_precision' => env('SPELL_MONEY_DECIMAL_PRECISION', 2),

    /*
    |--------------------------------------------------------------------------
    | Default Currency
    |--------------------------------------------------------------------------
    |
    | Default currency settings for different languages
    |
    */
    'currencies' => [
        'english' => [
            'currency' => env('SPELL_MONEY_CURRENCY', 'taka'),
            'subunit' => env('SPELL_MONEY_SUBUNIT', 'paisa'),
        ],
        'bengali' => [
            'currency' => 'টাকা',
            'subunit' => 'পয়সা',
        ],
        'hindi' => [
            'currency' => 'रुपये',
            'subunit' => 'पैसे',
        ],
        'urdu' => [
            'currency' => 'روپے',
            'subunit' => 'پیسے',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Language Classes
    |--------------------------------------------------------------------------
    |
    | Language implementation classes
    |
    */
    'language_classes' => [
        'english' => \Manoar\SpellMoney\Languages\English::class,
        'bengali' => \Manoar\SpellMoney\Languages\Bengali::class,
        'hindi' => \Manoar\SpellMoney\Languages\Hindi::class,
        'urdu' => \Manoar\SpellMoney\Languages\Urdu::class,
    ],
];
