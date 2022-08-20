<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Kiho;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class EarthKihoSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Cleansing Spirit');
        $this->create('Earth Needs No Eyes');
        $this->create('Earthen Fist');
        $this->create('Grasp the Earth Dragon', 3);
        $this->create('Way of the Earthquake', 2);
    }
}
