<?php

namespace TitasGailius\Dotto\Commands;

use Illuminate\Console\Command;
use Illuminate\Pipeline\Pipeline;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InstallCommand extends Command
{
    use ClearsScreen;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dotto:install {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Docker scaffolding for your Laravel application.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Pipeline $pipeline)
    {
        $this->laravel->instance(InputInterface::class, $this->input);
        $this->laravel->instance(OutputInterface::class, $this->output);

        Dotto::install($pipeline->send([])->through([
            Steps\SelectDatabase::class,
            Steps\ConfirmDatabaseCredentials::class,
            Steps\SelectPackageManager::class,
            Steps\ConfirmAssetDirectories::class,
            Steps\ConfirmQueues::class,
            Steps\ConfirmScheduler::class,
            Steps\ConfirmRouteCaching::class,
            Steps\ConfirmReplacements::class,
        ])->thenReturn());

        $this->clearScreen(2);
        $this->info('✅ Dotto was installed successfully.');
        $this->info('✅ You can now run "docker-compose up" to start the application.');
    }
}
