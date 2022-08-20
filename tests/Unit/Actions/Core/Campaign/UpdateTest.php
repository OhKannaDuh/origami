<?php

namespace Tests\Unit\Actions\Core\Campaign;

use App\Actions\ActionInterface;
use App\Actions\Core\Campaign\Update;
use App\Http\Requests\Campaign\UpdateRequest;
use App\Models\Core\Campaign;
use Tests\Unit\Actions\ActionTestCase;

final class UpdateTest extends ActionTestCase
{


    protected function getAction(): ActionInterface
    {
        return new Update();
    }


    public function providerContextException(): array
    {
        return [
            ['request', UpdateRequest::class, []],
            [
                'campaign',
                Campaign::class,
                ['request' => new UpdateRequest()],
            ],
        ];
    }
}
