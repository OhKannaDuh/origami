<?php

namespace Database\Seeders\SourceBooks\Shadowlands;

use Database\Seeders\SourceBooks\SourceBookSeeder;

final class Seeder extends SourceBookSeeder
{


    protected function getSourceBookParameters(): array
    {
        return [
            'key' => 'shadowlands',
            'name' => 'Shadowlands',
            'image' => '',
            'is_official' => true,
        ];
    }


    public function getPhaseOneSeeders(): array
    {
        return [
            ClanSeeder::class,
            FamilySeeder::class,
            TechniqueSeeder::class,
            ItemTypeSeeder::class,
            ItemSubtypeSeeder::class,
            ItemSeeder::class,
        ];
    }


    public function getPhaseTwoSeeders(): array
    {
        return [
            SchoolSeeder::class,
            AdvantageSeeder::class,
            DisadvantageSeeder::class,
        ];
    }
}
