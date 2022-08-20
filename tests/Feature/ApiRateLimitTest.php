<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Tests\TestCase;

final class ApiRateLimitTest extends TestCase
{


    public function testApiRateLimit1(): void
    {
        RateLimiter::resetAttempts('api');
        $limiter = RateLimiter::limiter('api');
        $request = Request::createFromBase(
            HttpFoundationRequest::create('/test')
        );

        $limiter($request);

        for ($x = 0; $x < RouteServiceProvider::API_LIMIT; $x++) {
            RateLimiter::hit('api');
        }

        // Any attempt after this should resolve in a failure, becuase our limit is RouteServiceProvider::API_LIMIT per second.
        $exceeds = RateLimiter::tooManyAttempts('api', RouteServiceProvider::API_LIMIT);
        self::assertTrue($exceeds);
    }


    public function testApiRateLimit2(): void
    {
        RateLimiter::resetAttempts('api');
        $limiter = RateLimiter::limiter('api');
        $request = Request::createFromBase(
            HttpFoundationRequest::create('/test')
        );

        $limiter($request);

        for ($x = 0; $x < RouteServiceProvider::API_LIMIT - 1; $x++) {
            RateLimiter::hit('api');
        }

        // Any attempt after this should resolve in a failure, becuase our limit is RouteServiceProvider::API_LIMIT per second.
        $exceeds = RateLimiter::tooManyAttempts('api', RouteServiceProvider::API_LIMIT);
        self::assertFalse($exceeds);
    }
}
