<?php

namespace TitasGailius\Dotto\Actions;

use TitasGailius\Dotto\Dotto;
use TitasGailius\Dotto\Contracts\Configuration;

class GenerateDockerfile
{
    /**
     * Dotto.
     *
     * @var \TitasGailius\Dotto\Dotto
     */
    protected $dotto;

    /**
     * Instantiate a new action instance.
     *
     * @param \TitasGailius\Dotto\Dotto $dotto
     */
    public function __construct(Dotto $dotto)
    {
        $this->dotto = $dotto;
    }

    /**
     * Handle the action.
     *
     * @param \TitasGailius\Dotto\Dotto $dotto
     * @param \TitasGailius\Dotto\Contracts\Configuration $config
     * @return void
     */
    public function handle(Configuration $config)
    {
        $view = view('dotto::Dockerfile', [
            'redis' => $config->hasRedis(),
            'slot' => $this->getExtendedDockerfile(),
        ]);

        file_put_contents(base_path('.dotto/Dockerfile'), $view);
    }

    /**
     * Get the extended "Dockerfile" file contents.
     *
     * @return string
     */
    protected function getExtendedDockerfile(): string
    {
        if ($path = $this->dotto->mergableDockerfile()) {
            return file_get_contents($path);
        }

        return '';
    }
}
