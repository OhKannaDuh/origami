<?php

namespace Database\Seeders\Character;

use App\Models\Core\ItemType;
use App\Repositories\Core\ItemTypeRepositoryInterface;
use Database\Seeders\Seeder;

final class ItemTypeSeeder extends Seeder
{


    public function run(ItemTypeRepositoryInterface $repository): void
    {
        $this->createFrom(ItemType::class, $repository);
    }
}
