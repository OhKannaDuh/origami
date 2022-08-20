<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Kiho;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class AirKihoSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Air Fist');
        $this->create('Riding the Clouds', 2);
        $this->create('The Great Silence');
        $this->create('Way of the Willow', 3);
    }
}
