<?php

namespace TitasGailius\Dotto\Steps;

class ConfirmQueues extends Step
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
        $this->clearScreen();

        $config['queues'] = $this->confirm('Setup Laravel Queue Workers?', true);

        return $next($config);
    }
}
