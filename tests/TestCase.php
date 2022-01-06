<?php

namespace Tests;

use Soved\Laravel\Ecologi\EcologiServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [EcologiServiceProvider::class];
    }
}
