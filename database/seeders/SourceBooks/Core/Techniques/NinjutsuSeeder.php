<?php

namespace Database\Seeders\SourceBooks\Core\Techniques;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class NinjutsuSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Skulk');
        $this->create('deadly Sting', 2);
        $this->create('Noxious Cloud', 3);
        $this->create('Silencing Stroke', 4);
    }
}
