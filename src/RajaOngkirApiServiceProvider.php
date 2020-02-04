<?php

namespace Miqdadyyy\RajaOngkirApi;

use Illuminate\Support\ServiceProvider;

class RajaOngkirApiServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'Miqdadyyy');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'Miqdadyyy');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/rajaongkirapi.php', 'rajaongkirapi');

        // Register the service the package provides.
        $this->app->singleton('rajaongkirapi', function ($app) {
            return new RajaOngkirApi;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['rajaongkirapi'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/rajaongkirapi.php' => config_path('rajaongkirapi.php'),
        ], 'rajaongkirapi.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/Miqdadyyy'),
        ], 'rajaongkirapi.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/Miqdadyyy'),
        ], 'rajaongkirapi.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/Miqdadyyy'),
        ], 'rajaongkirapi.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
