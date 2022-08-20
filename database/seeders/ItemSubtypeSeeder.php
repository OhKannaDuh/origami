<?php

namespace Database\Seeders;

use App\Repositories\Core\ItemSubtypeRepositoryInterface;
use App\Repositories\Core\ItemTypeRepositoryInterface;
use App\StringHelper;
use Illuminate\Database\Seeder;

final class ItemSubtypeSeeder extends Seeder
{


    public function run(
        ItemSubtypeRepositoryInterface $itemSubtypes,
        ItemTypeRepositoryInterface $itemTypes,
    ): void {
        $itemSubtypes->createMany([
            $this->getData('Sword', 'weapon', $itemTypes),
            $this->getData('Axe', 'weapon', $itemTypes),
            $this->getData('Blunt Weapon', 'weapon', $itemTypes),
            $this->getData('Hand Weapon', 'weapon', $itemTypes),
            $this->getData('Polearm', 'weapon', $itemTypes),
            $this->getData('Bow', 'weapon', $itemTypes),
            $this->getData('Crossbow', 'weapon', $itemTypes),
            $this->getData('Specialist Weapon', 'weapon', $itemTypes),
            $this->getData('Armor', 'armor', $itemTypes),
            $this->getData('Personal Effect', 'personal_effect', $itemTypes),
            $this->getData('Money', 'money', $itemTypes),
            $this->getData('Companion', 'companion', $itemTypes),
            $this->getData('Animals and Mounts', 'companion', $itemTypes),
        ]);
    }


    private function getData(string $name, string $key, ItemTypeRepositoryInterface $itemTypes): array
    {
        return[
            'item_type_id' => $itemTypes->getByKey($key)->getKey(),
            'key' => StringHelper::key($name),
            'name' => $name,
        ];
    }
}
