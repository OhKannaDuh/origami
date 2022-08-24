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
            ->assertJson(function (AssertableJson $json) {
                $json->has('items', 12);
                $items = $json->toArray()['items'];
                self::assertIsArray($items);

                foreach ($items as $item) {
                    self::assertIsArray($item);
                    self::assertArrayHasKey('item_subtype', $item);

                    $subtype = $item['item_subtype'];
                    self::assertIsArray($subtype);
                    self::assertArrayHasKey('item_type', $subtype);

                    $type = $subtype['item_type'];
                    self::assertIsArray($type);
                }
            });
    }
}
