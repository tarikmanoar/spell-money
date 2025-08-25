<?php

namespace Manoar\SpellMoney\Providers;

use Illuminate\Support\ServiceProvider;
use Manoar\SpellMoney\SpellMoney;
use Manoar\SpellMoney\Contracts\SpellMoneyInterface;

class SpellMoneyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/spell-money.php',
            'spell-money'
        );

        $this->app->singleton(SpellMoneyInterface::class, function ($app) {
            return new SpellMoney($app['config']['spell-money']);
        });

        $this->app->alias(SpellMoneyInterface::class, 'spell-money');
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/spell-money.php' => config_path('spell-money.php'),
            ], 'spell-money-config');
        }
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [
            SpellMoneyInterface::class,
            'spell-money',
        ];
    }
}
