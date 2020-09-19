<?php

namespace TitasGailius\Dotto\Tests;

use Orchestra\Testbench\TestCase;

abstract class TestCase extends TestCase
{
    /**
     * Get application service providers.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return ['TitasGailius\Dotto\DottoServiceProvider'];
    }
}
