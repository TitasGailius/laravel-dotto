<?php

namespace TitasGailius\Dotto;

use Illuminate\Support\ServiceProvider;

class DottoServiceProvider extends ServiceProvider
{
    /**
     * Register the package services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\UpCommand::class,
                Commands\DownCommand::class,
                Commands\InstallCommand::class,
            ]);

            $this->loadViewsFrom(__DIR__.'/dotto-stubs', 'dotto');
        }
    }
}
