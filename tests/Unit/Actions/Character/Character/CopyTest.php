<?php

namespace Tests\Unit\Actions\Character\Character;

use App\Actions\ActionInterface;
use App\Actions\Character\Character\Copy;
use App\Models\Character\Character;
use Tests\Unit\Actions\ActionTestCase;

final class CopyTest extends ActionTestCase
{


    protected function getAction(): ActionInterface
    {
        return new Copy();
    }


    public function providerContextException(): array
    {
        return [
            ['character', Character::class, []],
        ];
    }
}
