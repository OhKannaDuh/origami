<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Techniques;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class RitualSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Formal Tea Ceremony', 5);
        $this->create('Treaty Signing', 2);
        $this->create('The Ties that Bind', 2);
    }
}
