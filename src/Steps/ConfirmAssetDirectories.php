<?php

namespace TitasGailius\Dotto\Steps;

use Illuminate\Support\Str;

class ConfirmAssetDirectories extends Step
{
    /**
     * Common asset directories.
     *
     * @var array
     */
    protected $directories = [
        'ts', 'tsx', 'js', 'jsx',
        'css', 'sass', 'scss', 'less',
    ];

    /**
     * Handle question.
     *
     * @param  array  $config
     * @param  \Closure  $next
     * @return void
     */
    public function handle(array $config, $next)
    {
        $directories = $this->guessDirectories();

        do {
            $this->clearScreen(2);
            $this->info('❗️ Dotto is using a multi-stage Dockerfile to speed up the build process and keep things nice and simple.     ❗️');
            $this->info('❗️ Please make sure these are the correct frontend directories that laravel-mix is using to build the assets. ❗️');
            $this->info('');

            $this->table(['Directory'], $directories->map(function ($directory) {
                return [$directory];
            }));

            $answer = $this->choice('Do you want to continue?', [
                $good = 'Continue',
                $add = 'Add a directory',
                $remove = 'Remove a directory',
            ], 0);

            if ($answer === $add) {
                $directories = $this->addFrontendDirectory($directories);
            } else if ($answer === $remove) {
                $directories = $this->removeFrontendDirectory($directories);
            }
        } while ($answer !== $good);

        $config['assets'] = $directories->all();

        return $next($config);
    }

    /**
     * Add frontend directory.
     *
     * @param  \Illuminate\Support\Collection  $directories
     * @return void
     */
    protected function addFrontendDirectory($directories)
    {
        do {
            $directory = $this->ask('Please enter the directory path (empty to go back).');

            if (empty($directory)) {
                return $directories;
            }

            $missing = ! is_dir(base_path($directory));

            if ($missing) {
                $this->error('It looks like directory ['.$directory.'] does not exist.');
            }
        } while ($missing);

        return $directories->push($directory)->unique();
    }

    /**
     * Remove frontend directory.
     *
     * @param  \Illuminate\Support\Collection  $directories
     * @return void
     */
    protected function removeFrontendDirectory($directories)
    {
        $directory = $this->choice('Which directory would you like to remove?', $directories->merge(['None']));

        if (($key = array_search($directory, $directories)) !== false) {
            unset($directories[$key]);
        }

        return $directories;
    }

    /*
     * Guess frontend directories.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function guessDirectories()
    {
        return collect($this->directories)->filter(function (string $directory) {
            return is_dir(resource_path($directory));
        })->map(function (string $directory) {
            return str_replace(base_path('') . '/', '', resource_path($directory));
        });
    }
}
