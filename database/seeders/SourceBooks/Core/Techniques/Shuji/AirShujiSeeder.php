<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Shuji;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class AirShujiSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Artisan\'s Appraisal', 2);
        $this->create('Bend with the Storm', 5);
        $this->create('Cadence');
        $this->create('Feigned Opening', 2);
        $this->create('Prey on the Weak', 2);
        $this->create('Rustling of Leaves');
        $this->create('The Wind Blows Both Ways', 3);
        $this->create('Whispers of Court');
        $this->create('Wolf\'s Proposal', 4);
    }
}
