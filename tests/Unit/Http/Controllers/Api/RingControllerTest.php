<?php

namespace Tests\Unit\Http\Controllers\Api;

use App\Models\Core\Ring;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

final class RingControllerTest extends TestCase
{


    public function testAll(): void
    {
        Ring::factory(5)->create();

        $this->get(route('api.rings.all'))
            ->assertJson(fn(AssertableJson $json) => $json->has('rings', 5));
    }
}
