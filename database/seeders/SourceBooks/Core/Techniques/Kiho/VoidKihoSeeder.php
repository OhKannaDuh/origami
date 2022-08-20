<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Kiho;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class VoidKihoSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Death Touch', 4);
        $this->create('Still the Elements', 3);
        $this->create('Touch the Void Dragon', 5);
        $this->create('Way of the Edgeless Sword', 5);
    }
}
