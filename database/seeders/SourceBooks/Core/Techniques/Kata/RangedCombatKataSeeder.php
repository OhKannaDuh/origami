<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Kata;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class RangedCombatKataSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Hawk\'s Precision', 1);
        $this->create('Pelting Hail Style', 2);
        $this->create('Pin the Fan', 5);
    }
}
