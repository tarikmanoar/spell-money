<?php

/**
 * Laravel Integration Example
 *
 * This example shows how to use the Spell Money package in Laravel applications
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Manoar\SpellMoney\Facades\SpellMoney;
use Manoar\SpellMoney\Contracts\SpellMoneyInterface;

class InvoiceController extends Controller
{
    protected SpellMoneyInterface $spellMoney;

    public function __construct(SpellMoneyInterface $spellMoney)
    {
        $this->spellMoney = $spellMoney;
    }

    /**
     * Generate invoice with amount in words using Facade
     */
    public function generateInvoiceWithFacade(Request $request)
    {
        $amount = $request->input('amount', 15750.25);
        $language = $request->input('language', 'english');

        $amountInWords = SpellMoney::setLanguage($language)
            ->setCase('title')
            ->toCurrency($amount);

        return response()->json([
            'amount' => $amount,
            'amount_in_words' => $amountInWords,
            'language' => $language
        ]);
    }

    /**
     * Generate invoice with amount in words using Dependency Injection
     */
    public function generateInvoiceWithDI(Request $request)
    {
        $amount = $request->input('amount', 15750.25);
        $language = $request->input('language', 'english');

        $amountInWords = $this->spellMoney
            ->setLanguage($language)
            ->setCase('title')
            ->toCurrency($amount);

        return response()->json([
            'amount' => $amount,
            'amount_in_words' => $amountInWords,
            'language' => $language
        ]);
    }

    /**
     * Multi-language invoice generation
     */
    public function multiLanguageInvoice(Request $request)
    {
        $amount = $request->input('amount', 25000.50);
        $languages = ['english', 'bengali', 'hindi', 'urdu'];

        $results = [];

        foreach ($languages as $language) {
            $results[$language] = SpellMoney::setLanguage($language)
                ->setCase('sentence')
                ->toCurrency($amount);
        }

        return response()->json([
            'amount' => $amount,
            'translations' => $results
        ]);
    }

    /**
     * Banking check generation
     */
    public function generateCheck(Request $request)
    {
        $amount = $request->input('amount');
        $payee = $request->input('payee');
        $language = $request->input('language', 'english');
        $currency = $request->input('currency', 'taka');
        $subunit = $request->input('subunit', 'paisa');

        $amountInWords = SpellMoney::setLanguage($language)
            ->setCase('title')
            ->setCurrency($currency, $subunit)
            ->toCurrency($amount);

        return view('check', [
            'payee' => $payee,
            'amount' => $amount,
            'amount_in_words' => $amountInWords,
            'date' => now()->format('Y-m-d')
        ]);
    }
}

/**
 * Service class for financial calculations
 */
class FinancialService
{
    protected SpellMoneyInterface $spellMoney;

    public function __construct(SpellMoneyInterface $spellMoney)
    {
        $this->spellMoney = $spellMoney;
    }

    public function formatAmountForReport(float $amount, string $language = 'english'): array
    {
        return [
            'numerical' => number_format($amount, 2),
            'words' => $this->spellMoney
                ->setLanguage($language)
                ->setCase('title')
                ->toCurrency($amount)
        ];
    }

    public function generatePaymentVoucher(array $data): array
    {
        $amount = $data['amount'];
        $language = $data['language'] ?? 'english';

        return [
            'voucher_number' => $data['voucher_number'],
            'payee' => $data['payee'],
            'amount' => $amount,
            'amount_in_words' => $this->spellMoney
                ->setLanguage($language)
                ->setCase('sentence')
                ->toCurrency($amount),
            'purpose' => $data['purpose']
        ];
    }
}

/**
 * Custom Artisan Command
 */
use Illuminate\Console\Command;

class ConvertAmountCommand extends Command
{
    protected $signature = 'amount:convert {amount} {--language=english} {--case=lower} {--system=south_asian}';
    protected $description = 'Convert amount to words';

    public function handle()
    {
        $amount = $this->argument('amount');
        $language = $this->option('language');
        $case = $this->option('case');
        $system = $this->option('system');

        $result = SpellMoney::setLanguage($language)
            ->setCase($case)
            ->setNumberSystem($system)
            ->toCurrency($amount);

        $this->info("Amount: {$amount}");
        $this->info("In words: {$result}");
    }
}

/**
 * Model with SpellMoney integration
 */
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['amount', 'language', 'client_name'];

    public function getAmountInWordsAttribute(): string
    {
        return SpellMoney::setLanguage($this->language ?? 'english')
            ->setCase('title')
            ->toCurrency($this->amount);
    }

    public function getFormattedAmountAttribute(): array
    {
        return [
            'numerical' => number_format($this->amount, 2),
            'words' => $this->amount_in_words
        ];
    }
}

/**
 * Blade Template Helper
 */
// In AppServiceProvider boot method:
/*
use Illuminate\Support\Facades\Blade;
use Manoar\SpellMoney\Facades\SpellMoney;

Blade::directive('spellMoney', function ($expression) {
    return "<?php echo SpellMoney::toCurrency($expression); ?>";
});

Blade::directive('spellMoneyWith', function ($expression) {
    return "<?php echo SpellMoney::setLanguage({$expression['language']})
        ->setCase({$expression['case']})
        ->toCurrency({$expression['amount']}); ?>";
});
*/

/**
 * Usage in Blade templates:
 *
 * Basic usage:
 * @spellMoney(1500.50)
 *
 * With options:
 * @spellMoneyWith(['amount' => 1500.50, 'language' => 'bengali', 'case' => 'title'])
 *
 * Using facade directly:
 * {{ SpellMoney::setLanguage('hindi')->setCase('sentence')->toCurrency($amount) }}
 */
