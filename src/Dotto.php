<?php

namespace TitasGailius\Dotto;

use Illuminate\Console\Command;

class Dotto
{
    /**
     * Map stub views to destination files.
     *
     * @var array
     */
    public static $views = [
        'dotto::nginx-conf' => 'nginx.conf',
        'dotto::Dockerfile' => 'Dockerfile',
        'dotto::docker-compose-yml' => 'docker-compose.yml',
    ];

    /**
     * Dotto configuration.
     *
     * @var \TitasGailius\Dotto\Configuration
     */
    protected $config;

    /**
     * Instantiate a new dotto class.
     *
     * @param  \TitasGailius\Dotto\Configuration  $config
     * @return void
     */
    public function __construct(Configuration $config)
    {
        $this->config = $config;
    }

    /**
     * Install Dotto from a given configuration array.
     *
     * @param  array  $config
     * @return void
     */
    public static function install(array $config)
    {
        $dotto = new static(new Configuration($config));

        return $dotto->copyFiles();
    }

    /**
     * Install Dotto.
     *
     * @return void
     */
    public function copyFiles()
    {
        foreach (static::$views as $view => $destination) {
            $this->copyView($view, $destination);
        }
    }

    /**
     * Copy a givne view.
     *
     * @param  string $view
     * @param  string $destination
     * @return void
     */
    protected function copyView(string $view, string $destination)
    {
        if ($this->canCopy($path = base_path($destination))) {
            file_put_contents($path, view($view, ['config' => $this->config]));
        }
    }

    /**
     * Determine if the file can be copied.
     *
     * @param  string  $file
     * @return boolean
     */
    protected function canCopy(string $file)
    {
        return ! file_exists(base_path($file))
            || $this->config->force()
            || $this->config->canReplaceFile($file);
    }
}
