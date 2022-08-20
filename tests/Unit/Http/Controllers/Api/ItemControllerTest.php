<?php

namespace Tests\Unit\Http\Controllers\Api;

use App\Models\Character\Item;
use Illuminate\Support\Facades\Cache;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

final class ItemControllerTest extends TestCase
{


    public function testAll(): void
    {
        Item::factory(12)->create();

        $this->get(route('api.items.all'))
            ->assertJson(fn(AssertableJson $json) => $json->has('items', 12));
    }
}
