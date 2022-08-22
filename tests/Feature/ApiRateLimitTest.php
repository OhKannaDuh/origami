<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Tests\TestCase;

final class ApiRateLimitTest extends TestCase
{


    /**
     * Ensure guests get barred after hitting the api rate limit.
     */
    public function testApiRateLimit1(): void
    {
        RateLimiter::resetAttempts('api');
        $limiter = RateLimiter::limiter('api');
        $request = Request::createFromBase(
            HttpFoundationRequest::create('/test')
        );

        $limit = $limiter($request);
        self::assertSame($request->ip(), $limit->key);

        for ($x = 0; $x < RouteServiceProvider::API_LIMIT; $x++) {
            $hits = RateLimiter::hit('api');
            self::assertSame($x + 1, $hits);
        }

        // Any attempt after this should resolve in a failure, becuase our limit is RouteServiceProvider::API_LIMIT per second.
        $exceeds = RateLimiter::tooManyAttempts('api', RouteServiceProvider::API_LIMIT);
        self::assertTrue($exceeds);
    }


    /**
     * Ensure we don't hit that limit earlier than expected (guest).
     */
    public function testApiRateLimit2(): void
    {
        RateLimiter::resetAttempts('api');
        $limiter = RateLimiter::limiter('api');
        $request = Request::createFromBase(
            HttpFoundationRequest::create('/test')
        );

        $limit = $limiter($request);
        self::assertSame($request->ip(), $limit->key);

        for ($x = 0; $x < RouteServiceProvider::API_LIMIT - 1; $x++) {
            $hits = RateLimiter::hit('api');
            self::assertSame($x + 1, $hits);
        }

        // Any attempt after this should resolve in a failure, becuase our limit is RouteServiceProvider::API_LIMIT per second.
        $exceeds = RateLimiter::tooManyAttempts('api', RouteServiceProvider::API_LIMIT);
        self::assertFalse($exceeds);
    }


    /**
     * Ensure users get barred after hitting the api rate limit.
     */
    public function testApiRateLimit3(): void
    {
        RateLimiter::resetAttempts('api');
        $limiter = RateLimiter::limiter('api');
        $request = Request::createFromBase(
            HttpFoundationRequest::create('/test')
        );

        $user = User::factory()->create();
        $request->setUserResolver(fn(): User => $user);

        $limit = $limiter($request);
        self::assertSame((string) $user->id, $limit->key);

        for ($x = 0; $x < RouteServiceProvider::API_LIMIT; $x++) {
            $hits = RateLimiter::hit('api');
            self::assertSame($x + 1, $hits);
        }

        // Any attempt after this should resolve in a failure, becuase our limit is RouteServiceProvider::API_LIMIT per second.
        $exceeds = RateLimiter::tooManyAttempts('api', RouteServiceProvider::API_LIMIT);
        self::assertTrue($exceeds);
    }


    /**
     * Ensure we don't hit that limit earlier than expected (user).
     */
    public function testApiRateLimit4(): void
    {
        RateLimiter::resetAttempts('api');
        $limiter = RateLimiter::limiter('api');
        $request = Request::createFromBase(
            HttpFoundationRequest::create('/test')
        );

        $user = User::factory()->create();
        $request->setUserResolver(fn(): User => $user);

        $limit = $limiter($request);
        self::assertSame((string) $user->id, $limit->key);

        for ($x = 0; $x < RouteServiceProvider::API_LIMIT - 1; $x++) {
            $hits = RateLimiter::hit('api');
            self::assertSame($x + 1, $hits);
        }

        // Any attempt after this should resolve in a failure, becuase our limit is RouteServiceProvider::API_LIMIT per second.
        $exceeds = RateLimiter::tooManyAttempts('api', RouteServiceProvider::API_LIMIT);
        self::assertFalse($exceeds);
    }
}
