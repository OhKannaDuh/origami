<?php

namespace Tests\Unit\Actions\Character\Character;

use App\Actions\ActionInterface;
use App\Actions\Character\Character\SaveAdvantages;
use App\Http\Requests\Api\Character\SaveAdvantagesRequest;
use Tests\Unit\Actions\ActionTestCase;

final class SaveAdvantagesTest extends ActionTestCase
{


    protected function getAction(): ActionInterface
    {
        return new SaveAdvantages();
    }


    public function providerContextException(): array
    {
        return [
            ['request', SaveAdvantagesRequest::class, []],
        ];
    }
}
