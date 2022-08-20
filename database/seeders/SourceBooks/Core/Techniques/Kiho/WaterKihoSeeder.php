<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Kiho;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class WaterKihoSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Freezing the Lifeblood', 2);
        $this->create('Ki Protection');
        $this->create('Ride the Water Dragon', 3);
        $this->create('Water Fist');
        $this->create('Way of the Seafoam');
    }
}
