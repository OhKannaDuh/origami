<?php

namespace Tests\Unit;

use Tests\TestCase;

final class ApplicationTest extends TestCase
{


    public function testProviders(): void
    {
        $providers = $this->app['config']->get('app.providers');
        foreach ($providers as $provider) {
            self::assertTrue($this->app->providerIsLoaded($provider));
        }
    }
}
