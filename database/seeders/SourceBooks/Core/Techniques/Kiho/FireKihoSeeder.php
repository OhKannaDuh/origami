<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Kiho;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class FireKihoSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Breaking Blow');
        $this->create('Channel the Fire Dragon', 2);
        $this->create('Flame Fist');
        $this->create('The Body Is an Anvil');
        $this->create('Way of the Falling Star', 3);
    }
}
