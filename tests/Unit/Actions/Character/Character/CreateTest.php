<?php

namespace Tests\Unit\Actions\Character\Character;

use App\Actions\ActionInterface;
use App\Actions\Character\Character\Create;
use App\Http\Requests\Character\CreateRequest;
use Illuminate\Support\Facades\App;
use Tests\Unit\Actions\ActionTestCase;

final class CreateTest extends ActionTestCase
{


    protected function getAction(): ActionInterface
    {
        return App::make(Create::class);
    }


    public function providerContextException(): array
    {
        return [
            ['request', CreateRequest::class, []],
        ];
    }
}
