# Spell Money - Multi-## Supported Languages

### South Asian Languages
- **English** - International English
- **Bengali** - বাংলা
- **Hindi** - हिन्दी  
- **Urdu** - اردو
- **Tamil** - தமিழ்
- **Telugu** - తెలుগు
- **Malayalam** - മലയാളം
- **Kannada** - ಕನ್ನಡ
- **Gujarati** - ગુજરાતી
- **Marathi** - मराठी
- **Punjabi** - ਪੰਜਾਬੀ
- **Nepali** - नेपाली
- **Sinhala** - සිංහල
- **Assamese** - অসমীয়া

### Arabic Languages  
- **Arabic** - العربية (Modern Standard Arabic)

### European Languages
- **Spanish** - Español
- **Russian** - Русский

### East Asian Languages
- **Japanese** - 日本語
- **Chinese** - 中文 (Simplified/Traditional)

### Southeast Asian Languages
- **Malaysian** - Bahasa Malaysia
- **Thai** - ไทยWords Converter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tarikmanoar/spell-money.svg?style=flat-square)](https://packagist.org/packages/tarikmanoar/spell-money)
[![Tests](https://img.shields.io/github/actions/workflow/status/tarikmanoar/spell-money/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/tarikmanoar/spell-money/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/tarikmanoar/spell-money.svg?style=flat-square)](https://packagist.org/packages/tarikmanoar/spell-money)

A comprehensive Laravel package for converting numeric values into word representations supporting multiple languages and number systems.

Perfect for financial applications, invoice generation, check printing, and any application requiring human-readable number representations.

## Features

- 🌐 **Multi-language Support**: 21 languages including South Asian, Arabic, European, and Asian languages
- 🔢 **Dual Number Systems**: South Asian (lakh-crore) and International (million-billion)
- 💰 **Currency Mode**: Convert numbers to currency format with major and minor units
- 📝 **Case Formatting**: Support for title case, sentence case, lowercase, and uppercase
- ➖ **Negative Numbers**: Handle negative values with appropriate language words
- 🎯 **Decimal Precision**: Configurable decimal precision (0-2 digits)
- 🏗️ **Laravel Integration**: Service provider, facade, and configuration support
- 🔧 **Extensible**: Easy to extend with additional languages
- ✅ **Fully Tested**: Comprehensive test suite

## Supported Languages

### South Asian Languages
- **English** - International English
- **Bengali** - বাংলা
- **Hindi** - हिन्दी  
- **Urdu** - اردو
- **Tamil** - தமிழ்
- **Telugu** - తెలుగు
- **Malayalam** - മലയാളം
- **Kannada** - ಕನ್ನಡ
- **Gujarati** - ગુજરાતી
- **Marathi** - मराठी
- **Punjabi** - ਪੰਜਾਬੀ
- **Nepali** - नेपाली
- **Sinhala** - සිංහල

### Arabic Languages  
- **Arabic** - العربية (Modern Standard Arabic)

## Installation

Install the package via Composer:

```bash
composer require tarikmanoar/spell-money
```

For Laravel applications, the service provider will be automatically registered.

### Publish Configuration (Optional)

To customize the default settings, publish the configuration file:

```bash
php artisan vendor:publish --tag=spell-money-config
```

## Basic Usage

### Standalone Usage

```php
use Manoar\SpellMoney\SpellMoney;

$spellMoney = new SpellMoney();

// Basic number to words
echo $spellMoney->toWords(1234); // "one thousand two hundred thirty four"

// Currency conversion
echo $spellMoney->toCurrency(1234.56); // "one thousand two hundred thirty four taka and fifty six paisa"

// Backward compatibility method
echo $spellMoney->spell(1234.56); // "one thousand two hundred thirty four taka and fifty six paisa"
```

### Laravel Facade Usage

```php
use Manoar\SpellMoney\Facades\SpellMoney;

// Basic usage
SpellMoney::toWords(1234); // "one thousand two hundred thirty four"
SpellMoney::toCurrency(1234.56); // "one thousand two hundred thirty four taka and fifty six paisa"

// Method chaining
SpellMoney::setLanguage('bengali')
    ->setCase('title')
    ->toCurrency(1234.56); // "এক হাজার দুই শত চৌত্রিশ টাকা এবং ছাপ্পান্ন পয়সা"
```

### Dependency Injection

```php
use Manoar\SpellMoney\Contracts\SpellMoneyInterface;

class InvoiceController extends Controller
{
    public function generateInvoice(SpellMoneyInterface $spellMoney)
    {
        $amount = 15750.25;
        $amountInWords = $spellMoney->toCurrency($amount);
        // "fifteen thousand seven hundred fifty taka and twenty five paisa"
    }
}
```

## Configuration Options

### Language Settings

Set the language for number conversion:

```php
// South Asian Languages
$spellMoney->setLanguage('english');    // English (Default)
$spellMoney->setLanguage('bengali');    // Bengali - বাংলা
$spellMoney->setLanguage('hindi');      // Hindi - हिन्दी
$spellMoney->setLanguage('urdu');       // Urdu - اردو
$spellMoney->setLanguage('tamil');      // Tamil - தமிழ்
$spellMoney->setLanguage('telugu');     // Telugu - తెలుగు
$spellMoney->setLanguage('malayalam');  // Malayalam - മലയാളം
$spellMoney->setLanguage('kannada');    // Kannada - ಕನ್ನಡ
$spellMoney->setLanguage('gujarati');   // Gujarati - ગુજરાતી
$spellMoney->setLanguage('marathi');    // Marathi - मराठी
$spellMoney->setLanguage('punjabi');    // Punjabi - ਪੰਜਾਬੀ
$spellMoney->setLanguage('nepali');     // Nepali - नेपाली
$spellMoney->setLanguage('sinhala');    // Sinhala - සිංහල

// Arabic Languages
$spellMoney->setLanguage('arabic');     // Arabic - العربية
```

### Examples with Different Languages

```php
// English
$spellMoney->setLanguage('english');
echo $spellMoney->toCurrency(1234); // "one thousand two hundred thirty four taka"

// Bengali
$spellMoney->setLanguage('bengali');
echo $spellMoney->toCurrency(1234); // "এক হাজার দুই শত চৌত্রিশ টাকা"

// Tamil
$spellMoney->setLanguage('tamil');
echo $spellMoney->toCurrency(1234); // "ஒன்று ஆயிரம் இரண்டு நூறு மற்றும் முப்பத்திநான்கு ரூபாய்"

// Arabic  
$spellMoney->setLanguage('arabic');
echo $spellMoney->toCurrency(1234); // "واحد ألف اثنان مئة أربعة وثلاثون درهم"
```
```

### Number System

Choose between South Asian and International number systems:

```php
// South Asian system (default): lakh, crore
$spellMoney->setNumberSystem('south_asian');
echo $spellMoney->toWords(1000000); // "ten lakh"

// International system: million, billion
$spellMoney->setNumberSystem('international');
echo $spellMoney->toWords(1000000); // "one million"
```

### Case Formatting

Control the output case:

```php
$spellMoney->setCase('lower');    // "one hundred" (default)
$spellMoney->setCase('title');    // "One Hundred"
$spellMoney->setCase('sentence'); // "One hundred"
$spellMoney->setCase('upper');    // "ONE HUNDRED"
```

### Custom Currency

Set custom currency names:

```php
$spellMoney->setCurrency('dollar', 'cent');
echo $spellMoney->toCurrency(100.50); // "one hundred dollar and fifty cent"

$spellMoney->setCurrency('euro', 'cent');
echo $spellMoney->toCurrency(250.75); // "two hundred fifty euro and seventy five cent"
```

### Decimal Precision

Control decimal precision:

```php
$spellMoney->setDecimalPrecision(2); // Default - up to 2 decimal places
$spellMoney->setDecimalPrecision(1); // Only 1 decimal place
$spellMoney->setDecimalPrecision(0); // No decimals
```

## Language Examples

### English
```php
SpellMoney::setLanguage('english')->toCurrency(1234.56);
// "one thousand two hundred thirty four taka and fifty six paisa"
```

### Bengali
```php
SpellMoney::setLanguage('bengali')->toCurrency(1234.56);
// "এক হাজার দুই শত চৌত্রিশ টাকা এবং ছাপ্পান্ন পয়সা"
```

### Hindi
```php
SpellMoney::setLanguage('hindi')->toCurrency(1234.56);
// "एक हजार दो सौ चौंतीस रुपये और छप्पन पैसे"
```

### Urdu
```php
SpellMoney::setLanguage('urdu')->toCurrency(1234.56);
// "ایک ہزار دو سو چونتیس روپے اور چھپن پیسے"
```

### Tamil
```php
SpellMoney::setLanguage('tamil')->toCurrency(1234.56);
// "ஒன்று ஆயிரம் இரண்டு நூறு மற்றும் முப்பத்திநான்கு ரூபாய் மற்றும் ஐம்பத்தியாறு பைசா"
```

### Telugu
```php
SpellMoney::setLanguage('telugu')->toCurrency(1234.56);
// "ఒకటి వేలు రెండు వందలు ముప్పై నాలుగు రూపాయి మరియు యాభై ఆరు పైసా"
```

### Malayalam
```php
SpellMoney::setLanguage('malayalam')->toCurrency(1234.56);
// "ഒന്ന് ആയിരം രണ്ട് നൂറ് മുപ്പത്തിനാല് രൂപ ഉം അമ്പത്തിയാറ് പൈസ"
```

### Kannada
```php
SpellMoney::setLanguage('kannada')->toCurrency(1234.56);
// "ಒಂದು ಸಾವಿರ ಎರಡು ನೂರು ಮುಪ್ಪತ್ತನಾಲ್ಕು ರೂಪಾಯಿ ಮತ್ತು ಐವತ್ತಾರು ಪೈಸೆ"
```

### Gujarati
```php
SpellMoney::setLanguage('gujarati')->toCurrency(1234.56);
// "એક હજાર બે સો ચોત્રીસ રૂપિયા અને છપ્પન પૈસા"
```

### Marathi
```php
SpellMoney::setLanguage('marathi')->toCurrency(1234.56);
// "एक हजार दोन शे चौतीस रुपया आणि छप्पन्न पैसा"
```

### Punjabi
```php
SpellMoney::setLanguage('punjabi')->toCurrency(1234.56);
// "ਇਕ ਹਜ਼ਾਰ ਦੋ ਸੌ ਚੌਂਤੀ ਰੁਪਈਆ ਅਤੇ ਛਪੰਜਾ ਪੈਸਾ"
```

### Nepali
```php
SpellMoney::setLanguage('nepali')->toCurrency(1234.56);
// "एक हजार दुई सय चौंतीस रुपैयाँ र छप्पन पैसा"
```

### Arabic
```php
SpellMoney::setLanguage('arabic')->toCurrency(1234.56);
// "واحد ألف اثنان مئة أربعة وثلاثون درهم و ستة وخمسون فلس"
```

### Sinhala
```php
SpellMoney::setLanguage('sinhala')->toCurrency(1234.56);
// "එක දහස දෙක සිය තිස්හතර රුපියල සහ පනස්හය සත"
```

### Assamese
```php
SpellMoney::setLanguage('assamese')->toCurrency(1234.56);
// "এক হাজাৰ দুই শ চৌত্ৰিশ টকা আৰু ছাপ্পান্ন পইচা"
```

### Spanish
```php
SpellMoney::setLanguage('spanish')->toCurrency(1234.56);
// "uno mil doscientos y treinta y cuatro peso y cincuenta y seis centavo"
```

### Russian
```php
SpellMoney::setLanguage('russian')->toCurrency(1234.56);
// "один тысяча двести тридцать четыре рубль и пятьдесят шесть копейка"
```

### Japanese
```php
SpellMoney::setLanguage('japanese')->toCurrency(1234.56);
// "一千二百三十四 円 と 五十六 銭"
```

### Chinese
```php
SpellMoney::setLanguage('chinese')->toCurrency(1234.56);
// "一千二百三十四 元 和 五十六 角"
```

### Malaysian
```php
SpellMoney::setLanguage('malaysian')->toCurrency(1234.56);
// "satu ribu dua ratus dan tiga puluh empat ringgit dan lima puluh enam sen"
```

### Thai
```php
SpellMoney::setLanguage('thai')->toCurrency(1234.56);
// "หนึ่ง พัน สอง ร้อย และ สามสิบสี่ บาท และ ห้าสิบหก สตางค์"
```

## Advanced Examples

### Financial Application

```php
use Manoar\SpellMoney\Facades\SpellMoney;

class InvoiceGenerator
{
    public function generateInvoice($amount, $language = 'english')
    {
        $amountInWords = SpellMoney::setLanguage($language)
            ->setCase('title')
            ->toCurrency($amount);
        
        return "Amount in words: {$amountInWords}";
    }
}

$invoice = new InvoiceGenerator();
echo $invoice->generateInvoice(15750.75, 'bengali');
// "Amount in words: পনের হাজার সাত শত পঞ্চাশ টাকা এবং পঁচাত্তর পয়সা"
```

### Multi-language Report

```php
$amount = 50000.25;
$languages = ['english', 'bengali', 'hindi', 'urdu'];

foreach ($languages as $lang) {
    echo "{$lang}: " . SpellMoney::setLanguage($lang)
        ->setCase('sentence')
        ->toCurrency($amount) . "
";
}
```

### International vs South Asian System

```php
$amount = 2500000; // 2.5 million / 25 lakh

// South Asian system
echo SpellMoney::setNumberSystem('south_asian')->toWords($amount);
// "twenty five lakh"

// International system
echo SpellMoney::setNumberSystem('international')->toWords($amount);
// "two million five hundred thousand"
```

## Configuration File

The published configuration file (`config/spell-money.php`) allows you to set default values:

```php
return [
    'default_language' => env('SPELL_MONEY_LANGUAGE', 'english'),
    'default_number_system' => env('SPELL_MONEY_NUMBER_SYSTEM', 'south_asian'),
    'default_case' => env('SPELL_MONEY_CASE', 'lower'),
    'default_decimal_precision' => env('SPELL_MONEY_DECIMAL_PRECISION', 2),
    
    'currencies' => [
        'english' => ['currency' => 'taka', 'subunit' => 'paisa'],
        'bengali' => ['currency' => 'টাকা', 'subunit' => 'পয়সা'],
        'hindi' => ['currency' => 'रुपये', 'subunit' => 'पैसे'],
        'urdu' => ['currency' => 'روپے', 'subunit' => 'পیসে'],
    ],
];
```

### Environment Variables

Set defaults via environment variables:

```bash
SPELL_MONEY_LANGUAGE=bengali
SPELL_MONEY_NUMBER_SYSTEM=international
SPELL_MONEY_CASE=title
SPELL_MONEY_DECIMAL_PRECISION=1
SPELL_MONEY_CURRENCY=dollar
SPELL_MONEY_SUBUNIT=cent
```

## Extending with Custom Languages

Create a custom language by implementing the `LanguageInterface`:

```php
use Manoar\SpellMoney\Contracts\LanguageInterface;
use Manoar\SpellMoney\Languages\BaseLanguage;

class Spanish extends BaseLanguage
{
    public function getBasicNumbers(): array
    {
        return [
            0 => "cero", 1 => "uno", 2 => "dos", 3 => "tres",
            // ... implement all numbers 0-99
        ];
    }
    
    public function getSeparators(): array
    {
        return [
            0 => "",
            1 => "cientos",
            2 => "mil",
            3 => "lakh",
            4 => "crore"
        ];
    }
    
    // Implement other required methods...
}
```

## Number System Support

### South Asian System (Default)
- Units: ones, tens, hundreds
- Thousands: thousand
- Lakhs: 100,000 (1 lakh)
- Crores: 10,000,000 (1 crore)

### International System
- Units: ones, tens, hundreds
- Thousands: 1,000
- Millions: 1,000,000
- Billions: 1,000,000,000
- Trillions: 1,000,000,000,000

## Supported Number Range

- **Maximum**: Up to 99,99,99,999 (99 crore 99 lakh 99 thousand 999) in South Asian system
- **Decimals**: Up to 2 decimal places
- **Negative numbers**: Supported with appropriate negative words in each language

## Error Handling

The package handles various edge cases:

- Zero values
- Negative numbers
- Large numbers
- Decimal precision rounding
- Invalid language/system fallbacks

## Testing

Run the test suite:

```bash
composer test
```

Run tests with coverage:

```bash
composer test-coverage
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Contributions are welcome! Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Adding New Languages

1. Create a new language class extending `BaseLanguage`
2. Implement all required methods
3. Add comprehensive tests
4. Update configuration
5. Submit a pull request

## Security

If you discover any security-related issues, please email tarikmanoar@gmail.com instead of using the issue tracker.

## Credits

- [Tarik Manoar](https://github.com/tarikmanoar)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Support

- **Documentation**: This README and inline code documentation
- **Issues**: [GitHub Issues](https://github.com/tarikmanoar/spell-money/issues)
- **Discussions**: [GitHub Discussions](https://github.com/tarikmanoar/spell-money/discussions)

---

**Made with ❤️ for the PHP and Laravel community**
