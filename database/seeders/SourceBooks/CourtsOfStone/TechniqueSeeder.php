<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone;

use App\Models\Character\Technique;
use App\Models\Core\SourceBook;
use App\Models\Core\TechniqueSubtype;
use Illuminate\Database\Seeder;

final class TechniqueSeeder extends Seeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->execute(Techniques\CloseCombatKataSeeder::class, 'close_combat_kata', $sourceBook);
        $this->execute(Techniques\NinjutsuSeeder::class, 'ninjutsu', $sourceBook);
        $this->execute(Techniques\RitualSeeder::class, 'rituals', $sourceBook);
        $this->execute(Techniques\AirShujiSeeder::class, 'air_shuji', $sourceBook);
        $this->execute(Techniques\EarthShujiSeeder::class, 'earth_shuji', $sourceBook);
        $this->execute(Techniques\FireShujiSeeder::class, 'fire_shuji', $sourceBook);
        $this->execute(Techniques\WaterShujiSeeder::class, 'water_shuji', $sourceBook);
        $this->execute(Techniques\VoidShujiSeeder::class, 'void_shuji', $sourceBook);
    }


    private function execute(string $class, string $key, SourceBook $sourceBook): void
    {
        (new $class(
            $sourceBook,
            TechniqueSubtype::query()->where('key', $key)->first(['id']),
        ))->run();
    }
}
