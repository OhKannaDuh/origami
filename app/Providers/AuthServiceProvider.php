<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

final class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];


    /**
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
