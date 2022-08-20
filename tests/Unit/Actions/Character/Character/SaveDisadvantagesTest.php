<?php

namespace Tests\Unit\Actions\Character\Character;

use App\Actions\ActionInterface;
use App\Actions\Character\Character\SaveDisadvantages;
use App\Http\Requests\Api\Character\SaveDisadvantagesRequest;
use Tests\Unit\Actions\ActionTestCase;

final class SaveDisadvantagesTest extends ActionTestCase
{


    protected function getAction(): ActionInterface
    {
        return new SaveDisadvantages();
    }


    public function providerContextException(): array
    {
        return [
            ['request', SaveDisadvantagesRequest::class, []],
        ];
    }
}
