<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Techniques;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class FireShujiSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('All Shall Fear Me', 3);
        $this->create('Crackling Laughter', 3);
        $this->create('Offend the Sensibilities', 2);
        $this->create('Spiteful Loss', 1);
    }
}
