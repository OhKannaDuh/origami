<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Invocations;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class WaterInvocationsSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Bo of Water');
        $this->create('Dance of Seasons', 2);
        $this->create('Dominion of Suijin');
        $this->create('Ever-Changing Waves', 5);
        $this->create('Hands of the Tides', 3);
        $this->create('Heart of the Water Dragon', 2);
        $this->create('Inari\'s Blessing');
        $this->create('Path to Inner Peace');
        $this->create('Reflections of P\'an Ku');
        $this->create('Rise, Water', 4);
        $this->create('Stride the Waves', 2);
        $this->create('Strike the Tsunami', 3);
        $this->create('Suijin\'s Embrace', 4);
        $this->create('Sympathetic Energies', 2);
        $this->create('The Rushing Wave');
    }
}
