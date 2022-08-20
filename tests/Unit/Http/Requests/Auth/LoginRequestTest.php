<?php

namespace Tests\Unit\Http\Requests\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\Unit\Http\Requests\RequestTest;

final class LoginRequestTest extends RequestTest
{
    private User $user;


    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);
    }


    public function providerRequiredRules(): array
    {
        return [
            ['email'],
            ['password'],
        ];
    }


    /**
     * @return class-string<Request>&string
     */
    protected function getRequestClass(): string
    {
        return LoginRequest::class;
    }


    protected function getPayload(): array
    {
        return [
            'email' => $this->user->email,
            'password' => 'password',
        ];
    }
}
