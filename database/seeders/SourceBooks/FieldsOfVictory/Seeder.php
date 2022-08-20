<?php

namespace Database\Seeders\SourceBooks\FieldsOfVictory;

use Database\Seeders\SourceBooks\SourceBookSeeder;

final class Seeder extends SourceBookSeeder
{


    protected function getSourceBookParameters(): array
    {
        return [
            'key' => 'fields_of_victory',
            'name' => 'Fields of Victory',
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
