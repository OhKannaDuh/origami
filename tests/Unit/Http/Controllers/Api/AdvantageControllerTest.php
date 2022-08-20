<?php

namespace Tests\Unit\Http\Controllers\Api;

use App\Models\Character\Advantage;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

final class AdvantageControllerTest extends TestCase
{


    public function testAll(): void
    {
        Advantage::factory(3)->create();

        $this->get(route('api.advantages.all'))
            ->assertJson(fn(AssertableJson $json) => $json->has('advantages', 3));
    }
}
