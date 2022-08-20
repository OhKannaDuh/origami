<?php

namespace Tests\Unit\Actions\Character\Character;

use App\Actions\ActionInterface;
use App\Actions\Character\Character\Update;
use App\Http\Requests\Character\UpdateRequest;
use App\Models\Character\Character;
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
                'character',
                Character::class,
                ['request' => new UpdateRequest()],
            ],
        ];
    }
}
