<?php

namespace TitasGailius\Dotto\Steps;

class ConfirmFileReplacements extends Step
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
        $files = Dotto::getFiles();
        $this->clearScreen();

        $config['queues'] = $this->confirm('Setup Laravel Queue Workers?', true);

        return $next($config);
    }
}
