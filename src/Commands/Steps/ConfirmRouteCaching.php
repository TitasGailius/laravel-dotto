<?php

namespace TitasGailius\Dotto\Steps;

class ConfirmRouteCaching extends Step
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
        $this->clearScreen(2);

        $this->info('❗️ Closure based routes cannot be cached. ❗️');
        $this->info('❗️ To use route caching, you must convert any Closure routes to controller classes. ❗️');
        $this->info('');

        $config['cacheRoutes'] = $this->confirm('Setup Route caching?', true);

        return $next($config);
    }
}
