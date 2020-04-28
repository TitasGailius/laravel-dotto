<?php

namespace TitasGailius\Dotto\Commands;

trait ClearsScreen
{
    /**
     * Clear screen.
     *
     * @param  int  $newLineCount
     * @return void
     */
    public function clearScreen(int $newLineCount)
    {
        $this->output->writeln(sprintf("\033\143"));

        for ($i = 0; $i < $newLinCount; $i++) {
            $this->output->writeln('');
        }
    }
}
