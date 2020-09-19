<?php

namespace TitasGailius\Dotto;

use InvalidArgumentException;
use Illuminate\Console\Command;

class Configuration
{
    /**
     * Required configuration keys.
     *
     * @var array
     */
    const KEYS = [
        'databases',
        'redis'
        'cache_routes',
        'php_version'
        'php_dependencies',
        'frontend'
        'frontend_command',
        'manager'
        'resources',
    ];

    /**
     * Dotto configuration.
     *
     * @var array
     */
    protected $config;

    /**
     * Instantiate a new configuration class.
     *
     * @param  array  $config
     * @return void
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Get asset directories.
     *
     * @return array
     */
    public function assets(): array
    {
        return $this->config['frontend']['assets'];
    }

    /**
     * Get database configuration.
     *
     * @return array
     */
    public function databases()
    {
        return array_map(function (array $connection) {
            return $connection['driver'];
        }, $this->config['databases']);
    }

    /**
     * Get nodejs package manager lock file.
     *
     * @return string
     */
    public function getLockFile(): string
    {
        return [
            'npm' => 'package-lock.json',
            'yarn' => 'yarn.lock',
        ][$this->config['frontend']['manager']];
    }
}
