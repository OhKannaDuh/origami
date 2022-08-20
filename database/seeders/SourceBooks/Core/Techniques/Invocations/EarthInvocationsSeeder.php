<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Invocations;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class EarthInvocationsSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Armor of Earth');
        $this->create('Bind the Shadow', 2);
        $this->create('Caress of Earth');
        $this->create('Courage of Seven Thunders');
        $this->create('Earthquake', 4);
        $this->create('Earth Becomes Sky', 3);
        $this->create('Embrace of Kenro-Ji-Jin', 2);
        $this->create('Grasp of Earth');
        $this->create('Jade Strike');
        $this->create('Jurojin\'s Balm');
        $this->create('Power of the Earth Dragon', 3);
        $this->create('Rise, Earth', 4);
        $this->create('Symbol of Earth', 2);
        $this->create('Tetsubo of Earth');
        $this->create('Tomb of Jade', 5);
        $this->create('Wall of Earth');
    }
}
