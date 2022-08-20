<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Techniques;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class NinjutsuSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Like a Ghost', 2);
        $this->create('What\'s Yours Is Mine', 2);
        $this->create('Cunning Distraction', 2);
    }
}
