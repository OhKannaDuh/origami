<?php

namespace Tests\Unit\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

final class LogoutControllerTest extends TestCase
{


    public function testLogout(): void
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $this->post(route('auth.login.login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]));

        // Get token post login
        $token = session()->token();

        self::assertTrue($user->is(Auth::user()));


        $response = $this->post(route('auth.logout.logout'));

        $response->assertRedirect(route('index.show'));
        self::assertNull(Auth::user());

        // Ensure we not have a new token
        self::assertNotSame($token, session()->token());
    }
}
