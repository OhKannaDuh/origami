<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Techniques;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class RitualSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Treaty Signing', 2);
        $this->create('Hidden in Smoke', 4);
    }
}
