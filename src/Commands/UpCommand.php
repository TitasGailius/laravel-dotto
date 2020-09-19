<?php

namespace TitasGailius\Dotto\Commands;

use TitasGailius\Dotto\Dotto;
use Illuminate\Console\Command;
use Illuminate\Foundation\Application;
use TitasGailius\Dotto\LaravelConfigurator;
use Illuminate\Contracts\Filesystem\Filesystem;
use Symfony\Component\Console\Helper\ProcessHelper;
use Symfony\Component\Console\Output\OutputInterface;

class UpCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dotto:up';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start docker application.';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Contracts\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new route command instance.
     *
     * @param  \Illuminate\Contracts\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(LaravelConfigurator $configurator)
    {
        $views = (new Dotto(
            $configurator->getConfig()
        ))->getViews();

        dd($views);

        foreach ($views as $name => $view) {
            $this->put($name, $view);
        }

        Terminal::output($this)
                ->in(base_path())
                ->run('docker-compose up -f ' . $path);
    }

    /**
     * Put a given Dotto file.
     *
     * @param  string $name
     * @param  mixed $content
     * @return void
     */
    protected function put(string $name, $content)
    {
        $this->files->put($this->laravel->bootstrapPath('cache/'.$name), $content);
    }
}
