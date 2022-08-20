<?php

namespace Database\Seeders\SourceBooks\Core;

use App\Models\Core\SourceBook;
use App\Models\Core\TechniqueSubtype;
use Illuminate\Database\Seeder;

final class TechniqueSeeder extends Seeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->execute(Techniques\Kata\GeneralKataSeeder::class, 'general_kata', $sourceBook);
        $this->execute(Techniques\Kata\CloseCombatKataSeeder::class, 'close_combat_kata', $sourceBook);
        $this->execute(Techniques\Kata\RangedCombatKataSeeder::class, 'ranged_combat_kata', $sourceBook);

        $this->execute(Techniques\Kiho\EarthKihoSeeder::class, 'earth_kiho', $sourceBook);
        $this->execute(Techniques\Kiho\AirKihoSeeder::class, 'air_kiho', $sourceBook);
        $this->execute(Techniques\Kiho\FireKihoSeeder::class, 'fire_kiho', $sourceBook);
        $this->execute(Techniques\Kiho\WaterKihoSeeder::class, 'water_kiho', $sourceBook);
        $this->execute(Techniques\Kiho\VoidKihoSeeder::class, 'void_kiho', $sourceBook);

        $this->execute(Techniques\Invocations\AirInvocationsSeeder::class, 'air_invocations', $sourceBook);
        $this->execute(Techniques\Invocations\EarthInvocationsSeeder::class, 'earth_invocations', $sourceBook);
        $this->execute(Techniques\Invocations\FireInvocationsSeeder::class, 'fire_invocations', $sourceBook);
        $this->execute(Techniques\Invocations\WaterInvocationsSeeder::class, 'water_invocations', $sourceBook);

        $this->execute(Techniques\RitualSeeder::class, 'rituals', $sourceBook);

        $this->execute(Techniques\Shuji\AirShujiSeeder::class, 'air_shuji', $sourceBook);
        $this->execute(Techniques\Shuji\EarthShujiSeeder::class, 'earth_shuji', $sourceBook);
        $this->execute(Techniques\Shuji\FireShujiSeeder::class, 'fire_shuji', $sourceBook);
        $this->execute(Techniques\Shuji\WaterShujiSeeder::class, 'water_shuji', $sourceBook);
        $this->execute(Techniques\Shuji\VoidShujiSeeder::class, 'void_shuji', $sourceBook);

        $this->execute(Techniques\MahoSeeder::class, 'maho', $sourceBook);

        $this->execute(Techniques\NinjutsuSeeder::class, 'ninjutsu', $sourceBook);
    }


    private function execute(string $class, string $key, SourceBook $sourceBook): void
    {
        (new $class(
            $sourceBook,
            TechniqueSubtype::query()->where('key', $key)->first(['id']),
        ))->run();
    }
}
