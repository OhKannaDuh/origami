<?php

namespace Tests\Unit\Actions\User;

use App\Actions\ActionInterface;
use App\Actions\User\Logout;
use App\Http\Requests\AuthRequest;
use Tests\Unit\Actions\ActionTestCase;

final class LogoutTest extends ActionTestCase
{


    protected function getAction(): ActionInterface
    {
        return new Logout();
    }


    public function providerContextException(): array
    {
        return [
            ['request', AuthRequest::class, []],
        ];
    }
}
