<?php

namespace TitasGailius\Dotto\Commands;

use Illuminate\Console\Command;
use TitasGailius\Terminal\Terminal;
use Symfony\Component\Console\Helper\ProcessHelper;
use Symfony\Component\Console\Output\OutputInterface;

class DownCommand extends DockerCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dotto:down';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stop docker application.';

    /**
     * Get executable command.
     *
     * @return string
     */
    public function getCommand(): string
    {
        return 'docker-compose down';
    }
}
