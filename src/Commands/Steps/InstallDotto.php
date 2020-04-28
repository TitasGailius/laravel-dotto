<?php

namespace TitasGailius\Dotto\Steps;

use TitasGailius\Dotto\Dotto;

class InstallDotto extends Step
{
    /**
     * Handle question.
     *
     * @param  array  $config
     * @param  \Closure  $next
     * @return void
     */
    public function handle(array $config, $next)
    {
        Dotto::install($next($config));

        $this->info('✅ Dotto was installed successfully.');
        $this->info('✅ You can now run "docker-compose up" to start the application.');
    }
}
