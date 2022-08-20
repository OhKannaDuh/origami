<?php

namespace Tests\Unit\Models\Core;

use App\Models\Core\ItemSubtype;
use App\Models\Core\ItemType;
use Tests\TestCase;

final class ItemSubtypeTest extends TestCase
{


    public function testItemTypeRelationship(): void
    {
        $type = ItemType::factory()->create();

        $subtype = ItemSubtype::factory()->create();
        $subtype->itemType()->associate($type);

        self::assertTrue($subtype->itemType->is($type));
    }
}
