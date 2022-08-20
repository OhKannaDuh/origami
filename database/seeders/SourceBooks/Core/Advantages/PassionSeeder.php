<?php

namespace Database\Seeders\SourceBooks\Core\Advantages;

use Database\Seeders\SourceBooks\AdvantageSeeder;

final class PassionSeeder extends AdvantageSeeder
{


    public function run(): void
    {
        $this->create('Animal Bond', 'earth');
        $this->create('Armament', 'earth');
        $this->create('Brushwork', 'air');
        $this->create('Curiosity', 'fire');
        $this->create('Daredevil', 'fire');
        $this->create('Enlightenment', 'void');
        $this->create('Fashion', 'fire');
        $this->create('Fortune-Telling', 'void');
        $this->create('Generosity', 'water');
        $this->create('Gossip', 'air');
        $this->create('History', 'earth');
        $this->create('Ikebana', 'water');
        $this->create('Playfulness', 'air');
        $this->create('Provocation', 'fire');
        $this->create('Sake', 'water');
        $this->create('Secrets', 'void');
        $this->create('Stories', 'earth');
        $this->create('Tea', 'void');
        $this->create('Travel', 'water');
        $this->create('Wordplay', 'air');

        $this->create('Money', 'fire');
    }
}
