<?php

namespace Paiva\address\app\Providers;

use Carbon\Laravel\ServiceProvider;
use Paiva\address\app\Services\AuthenticateService;
use Paiva\address\app\Services\ListCitiesService;
use Paiva\address\app\Services\ListCountriesServices;
use Paiva\address\app\Services\ListNeighborhoodsService;
use Paiva\address\app\Services\ListStatesService;
use Paiva\address\app\Services\SearchAddressService;

class AddressServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/address.php', 'address');
    }

    /**
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/address.php' => config_path('address.php'),
        ], 'address-config');

        $this->publishes([
            __DIR__.'/../../database/migrations/' => database_path('migrations'),
        ], 'address-migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Paiva\address\Commands\PublishCommand::class,
            ]);
        }
    }
}
