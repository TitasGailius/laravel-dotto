<?php

namespace TitasGailius\Dotto\Console\Commands;

use Illuminate\Console\Command;
use TitasGailius\Terminal\Terminal;

class DottoStopCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dotto:stop';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Terminal::output($this)
            ->run('docker-compose -f .dotto/docker-compose.yml down');

        if ($response->ok()) {
            $this->info('Dotto services stopped successfully.');
        }
    }
}
