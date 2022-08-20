<?php

namespace Tests\Unit\Models\Character;

use App\Models\Character\Item;
use App\Models\Core\ItemSubtype;
use Tests\TestCase;

final class ItemTest extends TestCase
{


    public function testItemSubtypeRelationship(): void
    {
        $type = ItemSubtype::factory()->create();

        $item = Item::factory()->create();
        $item->itemSubtype()->associate($type);

        self::assertTrue($item->itemSubtype->is($type));
    }
}
