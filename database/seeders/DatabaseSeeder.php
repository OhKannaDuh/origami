<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{


    public function run(): void
    {
        $this->call([
            Core\SourceBookSeeder::class,
            Core\RingSeeder::class,
            Character\ItemTypeSeeder::class,
            Character\ItemSubtypeSeeder::class,
            Character\ItemSeeder::class,
            Core\SkillGroupSeeder::class,
            Core\SkillSeeder::class,
            Core\TechniqueTypeSeeder::class,
            Core\TechniqueSubtypeSeeder::class,
            Character\TechniqueSeeder::class,
            Core\AdvantageTypeSeeder::class,
            Core\DisadvantageTypeSeeder::class,
            Character\AdvantageSeeder::class,
            Character\DisadvantageSeeder::class,
            Character\ClanSeeder::class,
            Character\FamilySeeder::class,
            Core\SchoolTypeSeeder::class,
            Character\SchoolSeeder::class,
        ]);
    }
}
