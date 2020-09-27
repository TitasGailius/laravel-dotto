<?php

namespace TitasGailius\Dotto\Facades;

use TitasGailius\Dotto\Dotto as DottoManager;
use Illuminate\Support\Facades\Facade;

class Dotto extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return DottoManager::class;
    }

    /**
     * Instruct Dotto to merge the "Dockerfile" file.
     *
     * @return void
     */
    public static function mergeDockerfile()
    {
        static::resolved(function ($dotto) {
            $dotto->mergeDockerfile = true;
        });
    }

    /**
     * Instruct Dotto to merge the "docker-compose.yml" file.
     *
     * @return void
     */
    public static function mergeDockerfile()
    {
        static::resolved(function ($dotto) {
            $dotto->mergeDockerCompose = true;
        });
    }
}
