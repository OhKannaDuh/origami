<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone;

use Database\Seeders\SourceBooks\SourceBookSeeder;

final class Seeder extends SourceBookSeeder
{


    protected function getSourceBookParameters(): array
    {
        return [
            'key' => 'courts_of_stone',
            'name' => 'Courts of Stone',
            'image' => '',
            'is_official' => true,
        ];
    }


    public function getPhaseOneSeeders(): array
    {
        return [
            ItemTypeSeeder::class,
            ClanSeeder::class,
            FamilySeeder::class,
            TechniqueSeeder::class,
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
