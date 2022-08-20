<?php

namespace Database\Seeders\SourceBooks\CelestialRealms;

use Database\Seeders\SourceBooks\SourceBookSeeder;

final class Seeder extends SourceBookSeeder
{


    protected function getSourceBookParameters(): array
    {
        return [
            'key' => 'celestial_realms',
            'name' => 'Celestial Realms',
            'image' => '',
            'is_official' => true,
        ];
    }


    public function getPhaseOneSeeders(): array
    {
        return [];
    }


    public function getPhaseTwoSeeders(): array
    {
        return [];
    }
}
