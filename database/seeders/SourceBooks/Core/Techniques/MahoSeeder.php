<?php

namespace Database\Seeders\SourceBooks\Core\Techniques;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class MahoSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Incite Hanting');
        $this->create('Grip of Anguish');
        $this->create('Mark of Desecration');
        $this->create('Sinful Whispers');
        $this->create('Unholy Fervor');
    }
}
