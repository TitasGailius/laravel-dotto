<?php

namespace TitasGailius\Dotto;

use Illuminate\Console\Command;
use TitasGailius\Terminal\Terminal;
use Illuminate\Contracts\Container\Container;
use TitasGailius\Terminal\Contracts\Response;
use TitasGailius\Dotto\Contracts\Configuration;

class Dotto
{
    /**
     * Dotto configuration.
     *
     * @var \TitasGailius\Dotto\Configuration
     */
    protected $config;

    /**
     * Container instance.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;

    /**
     * Determine if the "Dockerfile" file should be merged.
     *
     * @var bool
     */
    public $mergeDockerfile = false;

    /**
     * Determine if the "docker-compose.yml" file should be merged.
     *
     * @var bool
     */
    public $mergeDockerCompose = false;

    /**
     * Instantiate a new dotto class.
     *
     * @param  \TitasGailius\Dotto\Configuration  $config
     * @param \Illuminate\Contracts\Container\Container  $container
     * @return void
     */
    public function __construct(Configuration $config, Container $container)
    {
        $this->config = $config;
        $this->container = $container;
    }

    /**
     * Start the dotto services.
     *
     * @param  \Illuminate\Console\Command  $command
     * @return \TitasGailius\Terminal\Contracts\Response
     */
    public function start(Command $command): Response
    {
        foreach ([
            Actions\EnsureDottoDirectoryExists::class,
            Actions\GenerateDockerCompose::class,
            Actions\GenerateDockerfile::class,
            Actions\GenerateNginxConfig::class,
        ] as $action) {
            $this->container->call($action, [], 'handle');
        }

        return Terminal::output($command)->run($this->startCommand());
    }

    /**
     * Get the "docker-compose up" command.
     *
     * @return string
     */
    protected function startCommand(): string
    {
        $command = 'docker-compose -f .dotto/docker-compose.yml up -d';

        if ($path = $this->mergableDockerCompose()) {
            return "{$command} -f ${path}";
        }

        return $command;
    }

    /**
     * Return the path to the mergable "docker-compose.yml" file.
     *
     * @return string|null
     */
    public function mergableDockerCompose(): ?string
    {
        $path = base_path('docker-compose.yml');

        if ($this->mergeDockerCompose && file_exists($path)) {
            return $path;
        }

        return null;
    }

    /**
     * Return the path to the mergable "Dockerfile" file.
     *
     * @return string|null
     */
    public function mergableDockerfile(): ?string
    {
        $path = base_path('Dockerfile');

        if ($this->mergeDockerfile && file_exists($path)) {
            return $path;
        }

        return null;
    }
}
