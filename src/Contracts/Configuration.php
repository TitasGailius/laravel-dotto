<?php

namespace TitasGailius\Dotto\Contracts;

interface Configuration
{
    /**
     * Determine if the applicaiton depends on a redis service.
     *
     * @return boolean
     */
    public function hasRedis(): bool;

    /**
     * Determine if the applicaiton depends on a musql service.
     *
     * @return boolean
     */
    public function hasMysql(): bool;

    /**
     * Get the default queue driver.
     *
     * @return string
     */
    public function getQueueDriver(): string;

    /**
     * Get the default queue driver.
     *
     * @return string
     */
    public function getCacheDriver(): string;

    /**
     * Get the default database driver.
     *
     * @return string
     */
    public function getDatabaseDriver(): string;
}
