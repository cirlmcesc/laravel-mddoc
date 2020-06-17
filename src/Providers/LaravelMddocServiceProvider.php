<?php

namespace Cirlmcesc\LaravelMddoc\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelMddocServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var boolean
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . "/../../config/mddoc.php", "mddoc");
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Commands
         */
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Cirlmcesc\LaravelMddoc\Commands\GenerateMarkdownCommand::class,
                \Cirlmcesc\LaravelMddoc\Commands\InstallCommand::class,
            ]);
        }

        /**
         * Config
         */
        $this->loadRoutesFrom(__DIR__ . "/../routes.php");

        $this->publishes([
            __DIR__ . "/../../config/mddoc.php" => config_path("mddoc.php"),
        ], "mddoc-config");

        /**
         * View
         */
        $this->loadViewsFrom(__DIR__ . "/../../views", 'laravelmddoc');

        $this->publishes([
            __DIR__ . '/../../public/vendor' => public_path("mddoc"),
        ], "mddoc-resources");
    }
}
