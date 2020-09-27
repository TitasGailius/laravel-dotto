<?php

namespace TitasGailius\Dotto;

use Illuminate\Support\Arr;
use Illuminate\Container\Container;
use TitasGailius\Dotto\Contracts\Configuration as ConfigurationContract;

class Configuration implements ConfigurationContract
{
    /**
     * Determine if the applicaiton depends on a redis service.
     *
     * @return boolean
     */
    public function hasRedis(): bool
    {
        return in_array('redis', [
            $this->getQueueDriver(),
            $this->getCacheDriver(),
        ]);
    }

    /**
     * Determine if the applicaiton depends on a musql service.
     *
     * @return boolean
     */
    public function hasMysql(): bool
    {
        return $this->getDatabaseDriver() === 'mysql';
    }

    /**
     * Get the default queue driver.
     *
     * @return string
     */
    public function getQueueDriver(): string
    {
        return Arr::get(
            config('queue.connections'),
            sprintf('%s.driver', config('queue.default'))
        );
    }

    /**
     * Get the default queue driver.
     *
     * @return string
     */
    public function getCacheDriver(): string
    {
        return Arr::get(
            config('cache.stores'),
            sprintf('%s.driver', config('cache.default'))
        );
    }

    /**
     * Get the default database driver.
     *
     * @return string
     */
    public function getDatabaseDriver(): string
    {
        return Arr::get(
            config('database.connections'),
            sprintf('%s.driver', config('database.default'))
        );
    }
}
