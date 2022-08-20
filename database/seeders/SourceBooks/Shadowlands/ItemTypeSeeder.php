<?php

namespace Database\Seeders\SourceBooks\Shadowlands;

use App\Repositories\Core\ItemTypeRepositoryInterface;
use Illuminate\Database\Seeder;

final class ItemTypeSeeder extends Seeder
{


    public function run(ItemTypeRepositoryInterface $itemTypes): void
    {
        $itemTypes->createMany([
            [
                'key' => 'signature_scroll',
                'name' => 'Signature Scroll',
            ],
            [
                'key' => 'item_pattern',
                'name' => 'Item Pattern',
            ],
        ]);
    }
}
