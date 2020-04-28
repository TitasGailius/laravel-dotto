<?php

namespace TitasGailius\Dotto\Steps;

class SelectPackageManager extends Step
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

        $config['manager'] = $this->choice('Which nodejs package manager would you like to use?', ['npm', 'yarn'], 0);

        return $next($config);
    }
}
