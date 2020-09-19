<?php

namespace TitasGailius\Dotto;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Foundation\Application;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Filesystem\Filesystem;

class LaravelConfigurator
{
    /**
     * PHP Version.
     */
    const PHP_VERSION = '7.3';

    /**
     * Base configuration.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * Filesystem.
     *
     * @var \Illuminate\Contracts\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Laravel Application.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Instantiate a new configurator instance.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @param  \Illuminate\Contracts\Filesystem\Filesystem  $files
     * @param  array  $config
     */
    public function __construct(Application $app, Filesystem $files, array $config = [])
    {
        $this->app = $app;
        $this->files = $files;
        $this->config = $config;
    }

    /**
     * Get configuration.
     *
     * @return \TitasGailius\Dotto\Configuration
     */
    public function getConfig()
    {
        $config = collect(Configuration::KEYS)->mapWithKeys(function (string $key) {
            return [$key => $this->get($key)];
        })->all();

        $config['databases'] = $this->expandDatabases($config['databases']);

        return new Configuration($config);
    }

    /**
     * Get configuration of a given key.
     *
     * @param  string $key
     * @return mixed
     */
    protected function get(string $key)
    {
        return $this->config[$key]
            ?? $this->{'get'.Str::studly($key)}();
    }

    /**
     * Get databases.
     *
     * @return array
     */
    protected function getDatabases()
    {
        return Arr::only($this->app['config']['database.connections'], $this->app['config']['database.default']);
    }

    /**
     * Determine if redis is enabled.
     *
     * @return boolean
     */
    protected function getRedis()
    {
        return in_array('redis', [
            $this->app['config']['queue.default'],
            $this->app['config']['cache.default'],
            $this->app['config']['session.driver'],
        ]);
    }


    /**
     * Determine if routes can be cached.
     *
     * @return boolean
     */
    protected function getCacheRoutes()
    {
        return collect($this->app['router']->getRoutes())->every(function ($route) {
            return ! $route->getAction('uses') instanceof Closure;
        });
    }

    /**
     * Get PHP version.
     *
     * @return string
     */
    protected function getPhpVersion()
    {
        return static::PHP_VERSION;
    }

    /**
     * Get frontend resources.
     *
     * @return array|null
     */
    protected function getResources()
    {
        return collect([
            'artisan',
            'package.json',
            'webpack.mix.js',
            'package-lock.json',
        ])->filter(function (string $file) {
            return $this->files->exists(base_path($file));
        })->all();
    }

    /**
     * Get PHP Dependencies.
     *
     * @return array
     */
    protected function getPhpDependencies()
    {
        return [
            'pdo', 'pdo_mysql', 'mbstring', 'opcache',
            'tokenizer', 'xml', 'ctype', 'json', 'bcmath', 'pcntl',
        ];
    }

    /**
     * Get PHP version.
     *
     * @return string
     */
    protected function phpVersion()
    {
        return static::PHP_VERSION;
    }

    /**
     * Get NodeJS package manager.
     *
     * @return string
     */
    protected function getManager()
    {
        if ($this->files->exists('yarn.lock')) {
            return 'yarn';
        }

        return 'npm';
    }

    /**
     * Determine if frontend assets are built.
     *
     * @return boolean
     */
    protected function getFrontend()
    {
        return ! $this->files->exists('yarn.lock')
            && ! $this->files->exists('package-lock.json')
            && ! $this->files->exists('webpack.mix.js');
    }

    /**
     * Get build comand for the frontend.
     *
     * @return string
     */
    protected function getBuildCommand()
    {
        return $this->getManager() === 'yarn'
            ? 'yarn production'
            ? 'npm run production';
    }

    /**
     * Expand given databases.
     *
     * @param  array $databases
     * @return array
     */
    protected function expandDatabases(array $databases)
    {
        if (! is_numeric(array_keys($databases)[0])) {
            return $databases;
        }

        return Arr::only($this->app['config']['database.connections'], $databases);
    }
}
