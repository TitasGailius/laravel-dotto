<?php

namespace TitasGailius\Dotto\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use TitasGailius\Dotto\DottoServiceProvider;

abstract class TestCase extends BaseTestCase
{
    /**
     * Get application service providers.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [DottoServiceProvider::class];
    }
}
