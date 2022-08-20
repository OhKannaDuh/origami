<?php

namespace Database\Seeders\SourceBooks\Core;

use Database\Seeders\SourceBooks\SourceBookSeeder;

final class Seeder extends SourceBookSeeder
{


    protected function getSourceBookParameters(): array
    {
        return [
            'key' => 'core',
            'name' => 'Core Rulebook',
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
