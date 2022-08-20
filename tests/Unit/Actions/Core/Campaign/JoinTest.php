<?php

namespace Tests\Unit\Actions\Core\Campaign;

use App\Actions\ActionInterface;
use App\Actions\Core\Campaign\Join;
use App\Http\Requests\AuthRequest;
use App\Models\Core\Campaign;
use Tests\Unit\Actions\ActionTestCase;

final class JoinTest extends ActionTestCase
{


    protected function getAction(): ActionInterface
    {
        return new Join();
    }


    public function providerContextException(): array
    {
        return [
            ['request', AuthRequest::class, []],
            [
                'campaign',
                Campaign::class,
                [
                    'request' => new AuthRequest(),
                ],
            ],
        ];
    }
}
