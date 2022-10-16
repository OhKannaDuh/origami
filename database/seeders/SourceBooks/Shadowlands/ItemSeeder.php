<?php

namespace Database\Seeders\SourceBooks\Shadowlands;

use App\Models\Core\ItemSubtype;
use App\Models\Core\SourceBook;
use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Seeder;

final class ItemSeeder extends Seeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->execute(Items\Weapons\SwordSeeder::class, 'sword', $sourceBook);
        $this->execute(Items\Weapons\AxeSeeder::class, 'axe', $sourceBook);
        $this->execute(Items\Weapons\CrossbowSeeder::class, 'crossbow', $sourceBook);
        $this->execute(Items\Weapons\ShieldSeeder::class, 'shield', $sourceBook);
        $this->execute(Items\Weapons\SiegeWeaponSeeder::class, 'siege_weapon', $sourceBook);

        $this->execute(Items\ArmorSeeder::class, 'armor', $sourceBook);

        $this->execute(Items\PersonalEffectsSeeder::class, 'personal_effect', $sourceBook);
        $this->execute(Items\PatternSeeder::class, 'item_pattern', $sourceBook);
    }


    private function execute(string $class, string $key, SourceBook $sourceBook): void
    {
        $seeder = new $class($sourceBook, ItemSubtype::query()->where('key', $key)->first(['id']));
        with(new Task($this->command->getOutput()))->render(
            get_class($seeder),
            fn () => $seeder->__invoke(),
        );
    }
}
