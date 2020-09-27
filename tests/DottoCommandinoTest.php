<?php

namespace TitasGailius\Dotto\Tests;

use TitasGailius\Dotto\Dotto;
use TitasGailius\Terminal\Terminal;

class DottoCommandinoTest extends TestCase
{
    public function testDottoCommand()
    {
        $this->mock(Dotto::class, function ($mock) {
            return $mock->shouldReceive('start')
                ->once()
                ->andReturn(Terminal::response('Success'));
        });

        $response = $this->atisan('dotto');

        dd('ok');
    }
}
