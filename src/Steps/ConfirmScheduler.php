<?php

namespace TitasGailius\Dotto\Steps;

class ConfirmScheduler extends Step
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

        $config['scheduler'] = $this->confirm('Setup Laravel Task Scheduling?', true);

        return $next($config);
    }
}
