<?php

namespace TitasGailius\Dotto\Actions;

use TitasGailius\Dotto\Contracts\Configuration;

class GenerateDockerCompose
{
    /**
     * Handle the action.
     *
     * @param \TitasGailius\Dotto\Contracts\Configuration $config
     * @return void
     */
    public function handle(Configuration $config)
    {
        $view = view('dotto::docker-compose-yml', [
            'redis' => $config->hasRedis(),
            'mysql' => $config->hasMysql(),
        ]);

        file_put_contents(base_path('.dotto/docker-compose.yml'), $view);
    }
}
