<?php

namespace Tests\Unit\Actions\Core\Campaign;

use App\Actions\ActionInterface;
use App\Actions\Core\Campaign\Delete;
use App\Models\Core\Campaign;
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
            ['campaign', Campaign::class, []],
        ];
    }
}
