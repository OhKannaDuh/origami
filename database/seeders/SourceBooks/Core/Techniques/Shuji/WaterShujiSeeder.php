<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Shuji;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class WaterShujiSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('All in Jest');
        $this->create('Buoyant Arrival', 5);
        $this->create('Ebb and Flow', 3);
        $this->create('Regal Bearing', 4);
        $this->create('Shallow Waters');
        $this->create('Slippery Maneuvers', 2);
        $this->create('Tributaries of Trade', 2);
        $this->create('Well of Desire');
    }
}
