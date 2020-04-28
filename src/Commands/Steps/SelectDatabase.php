<?php

namespace TitasGailius\Dotto\Steps;

class SelectDatabase extends Step
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

        $config['database']['connection'] = $this->choice('What database would you like to use?', ['mysql', 'mariadb'], 0);

        return $next($config);
    }
}
