<?php

namespace TitasGailius\Dotto\Console\Commands;

use Illuminate\Console\Command;
use TitasGailius\Terminal\Terminal;

class DottoTinkerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dotto:tinker';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Terminal::enableTty()
            ->run('docker exec -it dotto_app_1 php artisan tinker');
    }
}
