<?php

namespace Database\Seeders\SourceBooks\PathOfWaves;

use Database\Seeders\SourceBooks\SourceBookSeeder;

final class Seeder extends SourceBookSeeder
{


    protected function getSourceBookParameters(): array
    {
        return [
            'key' => 'path_of_waves',
            'name' => 'Path of Waves',
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
