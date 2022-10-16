<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Techniques;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class WaterShujiSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Beware The Smallest Mouse', 1);
        $this->create('Fun and Games', 1);
    }
}
