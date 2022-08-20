<?php

namespace Tests\Unit\Http\Controllers\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

final class LoginControllerTest extends TestCase
{


    public function testLoginSuccessful(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post(route('auth.login.login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]));

        $response->assertRedirect(route('index.show'));
        $response->assertSessionDoesntHaveErrors();
        self::assertTrue($user->is(Auth::user()));
    }


    public function testLoginSuccessfulNewSession(): void
    {
        Carbon::setTestNow(Carbon::now());

        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $token = session()->token();

        $response = $this->post(route('auth.login.login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]));

        self::assertNotSame($token, session()->token());

        $response->assertSessionHas('auth.password_confirmed_at', Carbon::now()->timestamp);
    }


    public function testLoginInvalidPassword(): void
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post(route('auth.login.login', [
            'email' => 'test@example.com',
            'password' => 'some-other-password',
        ]));


        $errors = session('errors');
        $response->assertSessionHasErrors([
            'email',
        ]);

        self::assertEquals('These credentials do not match our records.', $errors->get('email')[0]);
    }


    public function testLoginInvalidEmail(): void
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post(route('auth.login.login', [
            'email' => 'not-test@example.com',
            'password' => 'password',
        ]));


        $errors = session('errors');
        $response->assertSessionHasErrors([
            'email',
        ]);

        self::assertEquals('These credentials do not match our records.', $errors->get('email')[0]);
    }


    public function testLoginThrottle1(): void
    {
        Carbon::setTestNow(Carbon::now());

        $this->expectsEvents(Lockout::class);
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        for ($x = 0; $x < 5; $x++) {
            $this->post(route('auth.login.login', [
                'email' => 'not-test@example.com',
                'password' => 'incorrect',
            ]));
        }

        $response = $this->post(route('auth.login.login', [
            'email' => 'not-test@example.com',
            'password' => 'incorrect',
        ]));

        $response->assertSessionHasErrors();
        $errors = session('errors');
        self::assertSame('Too many login attempts. Please try again in 60 seconds.', $errors->get('email')[0]);
    }


    /**
     * Ensure we don't throttle too early
     */
    public function testLoginThrottle2(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        for ($x = 0; $x < 4; $x++) {
            $this->post(route('auth.login.login', [
                'email' => 'test@example.com',
                'password' => 'incorrect',
            ]));
        }

        $response = $this->post(route('auth.login.login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]));

        $response->assertRedirect(route('index.show'));
        $response->assertSessionDoesntHaveErrors();
        self::assertTrue($user->is(Auth::user()));
    }


    /**
     * Ensure we throttle based on ip and email.
     */
    public function testLoginThrottle3(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        for ($x = 0; $x < 5; $x++) {
            $this->post(route('auth.login.login', [
                'email' => 'not-test@example.com',
                'password' => 'incorrect',
            ]));
        }

        $response = $this->post(route('auth.login.login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]));

        $response->assertRedirect(route('index.show'));
        $response->assertSessionDoesntHaveErrors();
        self::assertTrue($user->is(Auth::user()));
    }


    /**
     * Ensure a successful login resets the throttle counter
     */
    public function testLoginThrottle4(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        for ($x = 0; $x < 4; $x++) {
            $this->post(route('auth.login.login', [
                'email' => 'test@example.com',
                'password' => 'incorrect',
            ]));
        }

        $response = $this->post(route('auth.login.login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]));

        Auth::guard()->logout();


        for ($x = 0; $x < 4; $x++) {
            $this->post(route('auth.login.login', [
                'email' => 'test@example.com',
                'password' => 'incorrect',
            ]));
        }

        $response = $this->post(route('auth.login.login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]));

        $response->assertRedirect(route('index.show'));
        $response->assertSessionDoesntHaveErrors();
        self::assertTrue($user->is(Auth::user()));
    }


    public function testLoginWithoutEmail(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post(route('auth.login.login', [
            'password' => 'password',
        ]));

        $response->assertRedirect(route('index.show'));
        $response->assertSessionHasErrors();
        $errors = session('errors');
        self::assertSame('The email field is required.', $errors->get('email')[0]);
    }


    public function testLoginWithoutPassword(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post(route('auth.login.login', [
            'email' => 'test@example.com',
        ]));

        $response->assertRedirect(route('index.show'));
        $response->assertSessionHasErrors();
        $errors = session('errors');
        self::assertSame('The password field is required.', $errors->get('password')[0]);
    }


    public function testShowGuest(): void
    {
        $this->get(route('auth.login.show'))
            ->assertInertia(fn (AssertableInertia $assert) => $assert->component('Auth/Login'));
    }


    public function testShowWuthUser(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        $this->get(route('auth.login.show'))->assertRedirect(route('index.show'));
    }
}
