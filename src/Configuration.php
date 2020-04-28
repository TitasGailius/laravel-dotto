<?php

namespace TitasGailius\Dotto;

use InvalidArgumentException;
use Illuminate\Console\Command;

class Configuration
{
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
     * Get database name.
     *
     * @return string
     */
    public function database(): string
    {
        if (! isset($this->config['database']['connection'])) {
            throw new InvalidArgumentException('Dotto database not specified.');
        }

        return $this->config['database']['connection'];
    }

    /**
     * Determine if the files should be replaced by default.
     *
     * @return bool
     */
    public function force()
    {
        return $this->config['force'] ?? false;
    }

    /**
     * Get allowed replacements.
     *
     * @return array
     */
    public function allowedReplacements(): array
    {
        return $this->config['replacements'] ?? [];
    }

    /**
     * Determine if the file can be replaced.
     *
     * @param  string  $file
     * @return bool
     */
    public function canReplaceFile(string $file): bool
    {
        return array_serch($destination, $this->allowedReplacements()) !== false;
    }

    /**
     * Determine if the routes are cached.
     *
     * @return bool
     */
    public function cacheRoutes(): bool
    {
        return $this->config['cacheRoutes'] ?? false;
    }

    /**
     * Get the node package manager.
     *
     * @return string
     */
    public function nodeManager(): string
    {
        return $this->config['manager'] ?? 'npm';
    }

    /**
     * Return a lock file for the node package manager.
     *
     * @return string
     */
    public function lockFile(): string
    {
        return [
            'npm' => 'package-lock.json',
            'yarn' => 'yarn.lock',
        ][$this->nodeManager()];
    }

    /**
     * Get asset directories.
     *
     * @return array
     */
    public function assets(): array
    {
        return $this->config['assets'] ?? [];
    }
}
