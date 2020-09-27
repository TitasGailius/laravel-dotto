<?php

namespace TitasGailius\Dotto\Actions;

class EnsureDottoDirectoryExists
{
    /**
     * Handle the action.
     *
     * @return void
     */
    public function handle()
    {
        $path = base_path('.dotto');

        if (file_exists($path)) {
            return;
        }

        mkdir($path);
    }
}
