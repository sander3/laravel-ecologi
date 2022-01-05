<?php

namespace Soved\Laravel\Ecologi;

use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Soved\Laravel\Ecologi\Contracts\EcologiContract;
use Illuminate\Foundation\Application as LaravelApplication;

class EcologiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->configure();
        $this->offerPublishing();

        $this->app->singleton(EcologiContract::class, Ecologi::class);
    }

    /**
     * Setup the configuration.
     *
     * @return void
     */
    protected function configure()
    {
        $source = realpath($raw = __DIR__.'/../config/ecologi.php') ?: $raw;

        if ($this->app instanceof LumenApplication) {
            $this->app->configure('ecologi');
        }

        $this->mergeConfigFrom($source, 'ecologi');
    }

    /**
     * Setup the resource publishing groups.
     *
     * @return void
     */
    protected function offerPublishing()
    {
        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/ecologi.php' => config_path('ecologi.php'),
            ], 'ecologi-config');
        }
    }
}
