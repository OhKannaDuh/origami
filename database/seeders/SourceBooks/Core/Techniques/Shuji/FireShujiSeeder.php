<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Shuji;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class FireShujiSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Bravado', 4);
        $this->create('Dazzling Performance', 3);
        $this->create('Fanning the Flames', 2);
        $this->create('Lightning Raid', 2);
        $this->create('Rallying Cry', 3);
        $this->create('Sear the Wound', 5);
        $this->create('Sensational Distraction');
        $this->create('Stirring the Embers');
        $this->create('Truth Burns through Lies');
    }
}
