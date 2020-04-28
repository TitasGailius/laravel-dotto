<?php

namespace TitasGailius\Dotto\Steps;

use TitasGailius\Dotto\InstallCommand;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Step
{
    use InteractsWithIO, ClearsScreen;

    /**
     * Instantiate a new question instance.
     *
     * @param  \Symfony\Component\Console\Input\Input  $input
     * @param  \Symfony\Component\Console\Output\Output  $output
     * @return void
     */
    public function __construct(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
    }
}
