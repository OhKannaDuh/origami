<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Techniques;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class CloseCombatKataSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Pole-Vault', 3);
        $this->create('Trip the Leg', 1);
    }
}
