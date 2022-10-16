<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Techniques;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class AirShujiSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Assess Strengths', 1);
        $this->create('Hidden in Smoke', 4);
    }
}
