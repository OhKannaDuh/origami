<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Techniques;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class NinjutsuSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Artful Alibi', 3);
        $this->create('Cunning Distraction', 2);
        $this->create('Deceitful Strike', 1);
        $this->create('Like a Ghost', 2);
        $this->create('Slicing Wind Kick', 3);
        $this->create('Silent Elimination', 3);
        $this->create('Stillness of Death', 5);
        $this->create('To Float or Sink', 2);
        $this->create('What\'s Yours Is Mine', 2);
    }
}
