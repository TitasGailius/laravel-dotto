<?php

namespace TitasGailius\Dotto\Console\Commands;

use TitasGailius\Dotto\Dotto;
use Illuminate\Console\Command;

class DottoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dotto {--m|merge : Merge "docker-compose.yml" and "Dockerfile" files}';

    /**
     * Execute the console command.
     *
     * @param \Illuminate\Container\Container $container
     * @return int
     */
    public function handle(Dotto $dotto)
    {
        if ($this->option('merge')) {
            $dotto->mergeDockerfile = true;
            $dotto->mergeDockerCompose = true;
        }

        $response = $dotto->start($this);

        if ($response->ok()) {
            $this->info('Dotto services started successfully.');
        }
    }
}
