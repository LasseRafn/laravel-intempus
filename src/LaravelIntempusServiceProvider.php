<?php

namespace LasseRafn\LaravelIntempus;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaravelIntempusServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/config/intempus.php';
        $this->mergeConfigFrom($configPath, 'intempus');

        $configPath = __DIR__ . '/config/intempus.php';

        if (function_exists('config_path')) {
            $publishPath = config_path('intempus.php');
        } else {
            $publishPath = base_path('config/intempus.php');
        }

        $this->publishes([$configPath => $publishPath], 'config');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
    }
}
