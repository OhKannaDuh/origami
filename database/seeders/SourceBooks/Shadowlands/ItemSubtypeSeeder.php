<?php

namespace Database\Seeders\SourceBooks\Shadowlands;

use App\Repositories\Core\ItemSubtypeRepositoryInterface;
use App\Repositories\Core\ItemTypeRepositoryInterface;
use Illuminate\Database\Seeder;

final class ItemSubtypeSeeder extends Seeder
{


    public function run(
        ItemSubtypeRepositoryInterface $itemSubtypes,
        ItemTypeRepositoryInterface $itemTypes
    ): void {
        $itemSubtypes->createMany([
            [
                'item_type_id' => $itemTypes->getByKey('weapon')->getKey(),
                'key' => 'shield',
                'name' => 'Shield',
            ],
            [
                'item_type_id' => $itemTypes->getByKey('weapon')->getKey(),
                'key' => 'siege_weapon',
                'name' => 'Siege Weapon',
            ],
            [
                'item_type_id' => $itemTypes->getByKey('signature_scroll')->getKey(),
                'key' => 'signature_scroll',
                'name' => 'Signature Scroll',
            ],
            [
                'item_type_id' => $itemTypes->getByKey('item_pattern')->getKey(),
                'key' => 'weapon_pattern',
                'name' => 'Weapon Pattern',
            ],
            [
                'item_type_id' => $itemTypes->getByKey('item_pattern')->getKey(),
                'key' => 'armor_pattern',
                'name' => 'Armor Pattern',
            ],
        ]);
    }
}
