<?php

namespace TitasGailius\Dotto\Steps;

class ConfirmDatabaseCredentials extends Step
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
        $config['database'] = array_merge($config['database'], $credentials = [
            'name' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
        ]);

        $this->clearScreen(2);

        $this->info('❗️ Docker builds a database container using credentials from the .env file.  ❗️');
        $this->info('❗️ Please make sure these credentials are correct before proceeding further. ❗️');
        $this->info('');

        $this->table(array_keys($credentials), [$credentials]);

        throw_unless(
            $this->confirm('Do you want to continue?', true),
            'Exception', 'Installation cancelled.'
        );

        return $next($config);
    }
}
