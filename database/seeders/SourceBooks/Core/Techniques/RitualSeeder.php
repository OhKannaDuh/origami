<?php

namespace Database\Seeders\SourceBooks\Core\Techniques;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class RitualSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Cleansing Rite');
        $this->create('Commune with the Spirits');
        $this->create('Divination');
        $this->create('Tea Ceremony', 2);
        $this->create('Threshold Barrier');
    }
}
