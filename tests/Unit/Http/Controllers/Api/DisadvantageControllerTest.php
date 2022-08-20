<?php

namespace Tests\Unit\Http\Controllers\Api;

use App\Models\Character\Disadvantage;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

final class DisadvantageControllerTest extends TestCase
{


    public function testAll(): void
    {
        Disadvantage::factory(45)->create();

        $this->get(route('api.disadvantages.all'))
            ->assertJson(fn(AssertableJson $json) => $json->has('disadvantages', 45));
    }
}
