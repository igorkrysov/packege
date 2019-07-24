<?php
namespace Techsmart\Currency;

use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    /**
     * Publishes files
     * 
     * @return void;
     */
    public function boot() {
        $this->publishes([
            // config
            __DIR__ . '/../config/currency.php' => config_path('currency.php'),
            // views
            __DIR__ . '/../resources/views/upload.blade.php' => resource_path('views/vendor/techsmart/currency/upload.blade.php'),
            __DIR__ . '/../resources/views/show.blade.php' => resource_path('views/vendor/techsmart/currency/show.blade.php'),
            // migrations
            __DIR__.'/../database/migrations' => database_path('migrations'),
            // translations
            // __DIR__.'/../resources/lang' => resource_path('lang/techsmart/currency'),            
            // assets
            // __DIR__.'/../resources/js' => public_path('techsmart/currency/js'),
            // __DIR__.'/../resources/css' => public_path('techsmart/currency/css'),
        ], 'currency');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }

    /**
     * Register service
     * 
     * @return void
     */
    public function register() {
        // $this->app->make();
        $this->app->make('Techsmart\Currency\Http\Controllers\CurrencyController');
    }


}