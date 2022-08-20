<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Invocations;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class FireInvocationsSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Armor of Radiance', 2);
        $this->create('Biting Steel');
        $this->create('Breath of the Fire Dragon', 3);
        $this->create('Extinguish');
        $this->create('Fukurokujin\'s Wit');
        $this->create('Fury of Osano-wo', 3);
        $this->create('Katan of Fire');
        $this->create('Matsu\'s Battlecry');
        $this->create('Ravenous Swarms', 3);
        $this->create('Rise, Flame', 4);
        $this->create('The Cleansing Fire');
        $this->create('The Fires from Within');
        $this->create('The Soul\'s Blade', 5);
        $this->create('Wall of Fire', 2);
        $this->create('Wings of the Phoenix', 4);
    }
}
