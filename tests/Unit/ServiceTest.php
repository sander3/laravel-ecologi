<?php

namespace Tests\Unit;

use Tests\TestCase;
use Soved\Laravel\Ecologi\Ecologi;
use Soved\Laravel\Ecologi\Contracts\EcologiContract;

class ServiceTest extends TestCase
{
    public function testSingleton(): void
    {
        $ecologi = $this->app->make(EcologiContract::class);

        $this->assertInstanceOf(Ecologi::class, $ecologi);
    }

    public function testTestModeDisabledByDefault(): void
    {
        $ecologi = $this->app->make(EcologiContract::class);

        $this->assertFalse($ecologi->test);
    }
}
