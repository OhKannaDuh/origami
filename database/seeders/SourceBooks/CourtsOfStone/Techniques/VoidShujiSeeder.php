<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Techniques;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class VoidShujiSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Foreseen Need', 4);
    }
}
