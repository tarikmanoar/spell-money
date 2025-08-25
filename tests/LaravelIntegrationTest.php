<?php

namespace Manoar\SpellMoney\Tests;

use Orchestra\Testbench\TestCase;
use Manoar\SpellMoney\Providers\SpellMoneyServiceProvider;
use Manoar\SpellMoney\Facades\SpellMoney;
use Manoar\SpellMoney\Contracts\SpellMoneyInterface;

class LaravelIntegrationTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SpellMoneyServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'SpellMoney' => SpellMoney::class,
        ];
    }

    public function testServiceProviderRegistration()
    {
        $this->assertTrue($this->app->bound(SpellMoneyInterface::class));
        $this->assertTrue($this->app->bound('spell-money'));
    }

    public function testFacadeWorks()
    {
        $result = SpellMoney::toWords(100);
        $this->assertEquals('one hundred', $result);

        $result = SpellMoney::toCurrency(150.25);
        $this->assertEquals('one hundred and fifty taka and twenty five paisa', $result);
    }

    public function testConfigurationWorks()
    {
        $this->app['config']->set('spell-money.default_case', 'title');
        $this->app['config']->set('spell-money.default_language', 'english');

        $spellMoney = $this->app->make(SpellMoneyInterface::class);
        $result = $spellMoney->toWords(100);

        // Due to config being set to title case
        $this->assertEquals('One Hundred', $result);
    }

    public function testFacadeMethodChaining()
    {
        $result = SpellMoney::setLanguage('english')
            ->setCase('title')
            ->setCurrency('dollar', 'cent')
            ->toCurrency(25.50);

        $this->assertEquals('Twenty Five Dollar And Fifty Cent', $result);
    }

    public function testConfigPublishing()
    {
        $this->artisan('vendor:publish', [
            '--tag' => 'spell-money-config',
            '--force' => true,
        ]);

        $this->assertFileExists(config_path('spell-money.php'));
    }
}
