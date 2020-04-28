<?php

namespace TitasGailius\Dotto\Steps;

use TitasGailius\Dotto\Dotto;

class ConfirmReplacements extends Step
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

        $config = $next($config);

        foreach (Dotto::$views as $file) {
            if ($this->canReplace($file)) {
                $config['replacements'][] = $file;
            }
        }

        return $config;
    }

    /**
     * Determine if a given file can be replaced.
     *
     * @param  string  $file
     * @return bool
     */
    protected function canReplace(string $file)
    {
        return file_exists(base_path($file))
            && $this->confirmReplacement($file);
    }

    /**
     * Confirm the replacement of a given file.
     *
     * @param  string  $file
     * @return bool
     */
    protected function confirmReplacement(string $file): bool
    {
        return $this->confirm(sprintf(
            'The [%s] file already exists. Do you want to replace it?',
            $file
        ));
    }
}
