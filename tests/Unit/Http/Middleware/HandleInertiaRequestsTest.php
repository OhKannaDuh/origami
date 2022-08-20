<?php

namespace Tests\Unit\Http\Middleware;

use App\Http\Middleware\HandleInertiaRequests;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Tests\TestCase;

use function Pest\Laravel\get;

final class HandleInertiaRequestsTest extends TestCase
{


    /**
     * Ensure auth.user is null when not part of the request.
     */
    public function testVersion(): void
    {
        $middleware = new HandleInertiaRequests();

        $request = Request::create('');
        $response = $middleware->version($request);

        $expected = vite()->getHash();

        self::assertSame($expected, $response);
    }


    /**
     * Ensure auth.user is null when not part of the request.
     */
    public function testShare1(): void
    {
        $middleware = new HandleInertiaRequests();

        $request = Request::create('');
        $response = $middleware->share($request);

        $resolver = Arr::get($response, 'auth.user');
        self::assertIsCallable($resolver);
        self::assertNull($resolver());
    }


    /**
     * Ensure auth.user is contains user data when part of the request.
     */
    public function testShare2(): void
    {
        $middleware = new HandleInertiaRequests();

        $user = User::factory()->create();

        $request = Request::create('');
        $request->setUserResolver(fn (): User => $user);

        $response = $middleware->share($request);

        $resolver = Arr::get($response, 'auth.user');
        self::assertIsCallable($resolver);

        $expected = array_merge(
            $user->only('id', 'name', 'email'),
            ['avatar' => $user->getAvatarUrl()],
        );

        self::assertEmpty(array_diff($expected, $resolver()));
    }


    public function testShare3(): void
    {
        $middleware = new HandleInertiaRequests();

        session()->put('errors', (new ViewErrorBag())->put('name', (new MessageBag([
            'there was a problem',
            'test',
        ]))));

        $request = Request::create('');
        $request->setLaravelSession(session());
        $response = $middleware->share($request);

        $errors = (array) $response['errors']();
        self::assertEquals([
            'name' => (object) [
                'there was a problem',
                'test',
            ],
        ], $errors);
    }


    public function testShare4(): void
    {
        $middleware = new HandleInertiaRequests();

        $request = Request::create('');
        $response = $middleware->share($request);

        self::assertArrayHasKey('versions', $response);
        self::assertTrue(Arr::has($response, 'versions.php'));
        self::assertTrue(Arr::has($response, 'versions.laravel'));
        self::assertSame(PHP_VERSION, Arr::get($response, 'versions.php'));
        self::assertSame(Application::VERSION, Arr::get($response, 'versions.laravel'));
    }


    public function testShare5(): void
    {
        $middleware = new HandleInertiaRequests();

        session()->flash('message', 'test message');

        $request = Request::create('');
        $request->setLaravelSession(session());
        $response = $middleware->share($request);

        self::assertSame('test message', Arr::get($response, 'flash.message')());
    }
}
