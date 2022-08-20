<?php

namespace Database\Seeders;

use App\Repositories\Core\ItemTypeRepositoryInterface;
use Illuminate\Database\Seeder;

final class ItemTypeSeeder extends Seeder
{


    public function run(ItemTypeRepositoryInterface $itemTypes): void
    {
        $itemTypes->createMany([
            [
                'key' => 'weapon',
                'name' => 'Weapon',
            ],
            [
                'key' => 'armor',
                'name' => 'Armor',
            ],
            [
                'key' => 'personal_effect',
                'name' => 'Personal Effect',
            ],
            [
                'key' => 'money',
                'name' => 'Money',
            ],
            [
                'key' => 'companion',
                'name' => 'Companion',
            ],
        ]);
    }
}
