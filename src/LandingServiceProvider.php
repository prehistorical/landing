<?php namespace Prehistorical\Landing;

use Illuminate\Support\ServiceProvider;

class LandingServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //Publishes package config file to applications config folder
        $this->publishes([__DIR__.'/config/landing.php' => config_path('landing.php')]);

        $this->publishes([
            __DIR__.'/migrations' => $this->app->databasePath().'/migrations'
        ], 'migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Let Laravel Ioc Container know about our Controller
        $this->app->make('Prehistorical\Landing\CreateController');
        $this->app->make('Prehistorical\Landing\SaveController');
        $this->app->make('Prehistorical\Landing\DeleteController');

        include __DIR__.'/routes.php';
    }

}