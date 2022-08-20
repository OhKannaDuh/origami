<?php

namespace Tests\Unit\Actions\Character\Character;

use App\Actions\ActionInterface;
use App\Actions\Character\Character\SaveStats;
use App\Http\Requests\Api\Character\SaveStatsRequest;
use Tests\Unit\Actions\ActionTestCase;

final class SaveStatsTest extends ActionTestCase
{


    protected function getAction(): ActionInterface
    {
        return new SaveStats();
    }


    public function providerContextException(): array
    {
        return [
            ['request', SaveStatsRequest::class, []],
        ];
    }
}
