<?php

namespace TitasGailius\Dotto;

use Illuminate\Support\ServiceProvider;
use TitasGailius\Dotto\Contracts\Configuration as ConfigurationContract;

class DottoServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ConfigurationContract::class, Configuration::class);
    }

    /**
     * Register the package services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\DottoCommand::class,
                Console\Commands\DottoStopCommand::class,
                Console\Commands\DottoEnterCommand::class,
                Console\Commands\DottoLogsCommand::class,
                Console\Commands\DottoTinkerCommand::class,
            ]);

            $this->loadViewsFrom(__DIR__.'/views', 'dotto');
        }
    }
}
