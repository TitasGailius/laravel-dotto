<?php

namespace TitasGailius\Dotto\Actions;

use TitasGailius\Dotto\Configuration;

class GenerateNginxConfig
{
    /**
     * Handle the action.
     *
     * @return void
     */
    public function handle()
    {
        copy(__DIR__.'/../views/nginx.conf', base_path('.dotto/nginx.conf'));
    }
}
