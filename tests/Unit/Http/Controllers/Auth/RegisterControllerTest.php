<?php

namespace Tests\Unit\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

final class RegisterControllerTest extends TestCase
{


    public function testRegisterSuccesful(): void
    {
        Event::fake(Registered::class);

        $response = $this->post(route('auth.register.show'), [
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('index.show'));
        self::assertSame('test@example.com', Auth::user()->email);

        Event::assertDispatched(Registered::class);
    }


    public function testRegisterUsedEmail(): void
    {
        User::factory()->create([
            'email' => 'test@example.com',
        ]);

        $response = $this->post(route('auth.register.show'), [
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $errors = session('errors');
        $response->assertSessionHasErrors([
            'email',
        ]);
        self::assertSame($errors->get('email')[0], 'The email has already been taken.');
    }


    public function testRegisterInvalidPasswordConfirmation(): void
    {
        $response = $this->post(route('auth.register.show'), [
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'not-password',
        ]);

        $errors = session('errors');
        $response->assertSessionHasErrors([
            'password',
        ]);
        self::assertSame($errors->get('password')[0], 'The password confirmation does not match.');
    }


    public function testShowRegistrationForm(): void
    {
        $this->get(route('auth.register.show'))
            ->assertInertia(fn (AssertableInertia $assert) => $assert->component('Auth/Register'));
    }
}
