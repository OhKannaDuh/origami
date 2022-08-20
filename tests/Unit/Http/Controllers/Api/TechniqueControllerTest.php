<?php

namespace Tests\Unit\Http\Controllers\Api;

use App\Models\Character\Technique;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

final class TechniqueControllerTest extends TestCase
{


    public function testAll(): void
    {
        Technique::factory(4)->create();

        $this->get(route('api.techniques.all'))
            ->assertJson(fn(AssertableJson $json) => $json->has('techniques', 4));
    }
}
