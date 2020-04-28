<?php

namespace TitasGailius\Dotto\Commands;

use Illuminate\Console\Command;
use TitasGailius\Terminal\Terminal;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

abstract class DockerCommand extends Command
{
    /**
     * Get executable command.
     *
     * @return string
     */
    abstract public function getCommand(): string;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Terminal::in(base_path(''))
                ->output($this->output)
                ->run($this->getCommand());
    }
}
