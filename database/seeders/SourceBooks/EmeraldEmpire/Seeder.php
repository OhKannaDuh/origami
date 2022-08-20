<?php

namespace Database\Seeders\SourceBooks\EmeraldEmpire;

use Database\Seeders\SourceBooks\SourceBookSeeder;

final class Seeder extends SourceBookSeeder
{


    protected function getSourceBookParameters(): array
    {
        return [
            'key' => 'emerald_empire',
            'name' => 'Emerald Empire',
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
