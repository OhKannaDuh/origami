<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Kata;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class CloseCombatKataSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Coiling Serpent Style', 2);
        $this->create('Iaijutsu Cut: Crossing Blade', 2);
        $this->create('Iaijutsu Cut: Rising Blade', 2);
        $this->create('Iron Forest Style', 2);
        $this->create('Open-Hand Style', 2);
        $this->create('Rushing Avalanche Style', 2);
        $this->create('Spinning Blades Style', 2);
        $this->create('Thunderclap Strike', 3);
        $this->create('Veiled Menace Style', 2);
    }
}
