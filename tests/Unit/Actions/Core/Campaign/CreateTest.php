<?php

namespace Tests\Unit\Actions\Core\Campaign;

use App\Actions\ActionInterface;
use App\Actions\Core\Campaign\Create;
use App\Http\Requests\Campaign\CreateRequest;
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
