<?php

namespace Tests\Unit\Actions\User;

use App\Actions\ActionInterface;
use App\Actions\User\Login;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Tests\Unit\Actions\ActionTestCase;

final class LoginTest extends ActionTestCase
{


    protected function getAction(): ActionInterface
    {
        return App::make(Login::class);
    }


    public function providerContextException(): array
    {
        return [
            ['request', LoginRequest::class, []],
        ];
    }


    public function testExecute(): void
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        $action = $this->getAction();
        $request = LoginRequest::create('', 'POST', [
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $request->setLaravelSession(session());

        $response = $action->execute(['request' => $request]);
        self::assertInstanceOf(RedirectResponse::class, $response);
    }
}
