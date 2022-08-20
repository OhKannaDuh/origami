<?php

namespace Tests\Unit\Actions\Character\Character;

use App\Actions\ActionInterface;
use App\Actions\Character\Character\Delete;
use App\Models\Character\Character;
use Tests\Unit\Actions\ActionTestCase;

final class DeleteTest extends ActionTestCase
{


    protected function getAction(): ActionInterface
    {
        return new Delete();
    }


    public function providerContextException(): array
    {
        return [
            ['character', Character::class, []],
        ];
    }
}
