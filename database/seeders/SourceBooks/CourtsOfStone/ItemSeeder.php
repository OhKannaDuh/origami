<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone;

use App\Models\Core\ItemSubtype;
use App\Models\Core\SourceBook;
use Illuminate\Database\Seeder;

final class ItemSeeder extends Seeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->execute(Items\Weapons\SwordSeeder::class, 'sword', $sourceBook);
        $this->execute(Items\Weapons\BowSeeder::class, 'bow', $sourceBook);
        $this->execute(Items\Weapons\SpecialistWeaponSeeder::class, 'specialist_weapon', $sourceBook);

        $this->execute(Items\ArmorSeeder::class, 'armor', $sourceBook);

        $this->execute(Items\PersonalEffectsSeeder::class, 'personal_effect', $sourceBook);
        $this->execute(Items\ShinobiItemSeeder::class, 'shinobi_items', $sourceBook);
    }


    private function execute(string $class, string $key, SourceBook $sourceBook): void
    {
        (new $class(
            $sourceBook,
            ItemSubtype::query()->where('key', $key)->first(['id']),
        ))->run();
    }
}
