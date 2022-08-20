<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone;

use App\Models\Core\ItemSubtype;
use App\Models\Core\ItemType;
use App\Models\Core\SourceBook;
use Illuminate\Database\Seeder;

final class ItemTypeSeeder extends Seeder
{


    public function run(): void
    {
        $type = ItemType::query()->create([
            'key' => 'shinobi_items',
            'name' => 'Shinobi Items',
        ]);

        ItemSubtype::query()->create([
            'item_type_id' => $type->getKey(),
            'key' => 'shinobi_items',
            'name' => 'Shinobi Items',
        ]);
    }
}
