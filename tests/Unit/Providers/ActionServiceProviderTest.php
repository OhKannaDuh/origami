<?php

namespace Tests\Unit\Providers;

use App\Providers\ActionServiceProvider;
use Tests\TestCase;
use Throwable;

final class ActionServiceProviderTest extends TestCase
{


    public function testBindRequiresInterface(): void
    {
        $this->app['config']->set('actions.namespaces.action', 'App\\Repositories');
        $errors = false;

        try {
            (new ActionServiceProvider($this->app))->boot();
        } catch (Throwable) {
            $errors = true;
        }

        self::assertFalse($errors);
    }
}
