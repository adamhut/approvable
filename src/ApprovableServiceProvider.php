<?php

namespace Adamhut\Approvable;

use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Adamhut\Approvable\Commands\ApprovalSummary;

class ApprovableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(Filesystem $filesystem)
    {

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('approvable.php'),
            ], 'config');

             $this->publishes([
                __DIR__. '/../database/migrations/create_approvals_table.php.stub' => $this->getMigrationFileName($filesystem),
            ], 'migrations');


            // Registering package commands.
            $this->commands([
                ApprovalSummary::class
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'approvable');

        // Register the main class to use with the facade
        $this->app->singleton('approvable', function () {
            return new Approvable;
        });
    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @param Filesystem $filesystem
     * @return string
     */
    protected function getMigrationFileName(Filesystem $filesystem): string
    {
        $timestamp = date('Y_m_d_His');

        return Collection::make($this->app->databasePath().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem) {
                return $filesystem->glob($path.'*_create_permission_tables.php');
            })->push($this->app->databasePath()."/migrations/{$timestamp}_create_approvals_table.php")
            ->first();
    }
}
