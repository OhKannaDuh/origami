<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Kata;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class GeneralKataSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Battle in the Mind', 3);
        $this->create('Breath of Wind Style', 4);
        $this->create('Crashing Wave Style', 4);
        $this->create('Crescent Moon Style', 2);
        $this->create('Crimson Leaves Strike', 3);
        $this->create('Disappearing World Style', 4);
        $this->create('Flowing Water Strike', 3);
        $this->create('Heartpiercing Strike', 3);
        $this->create('Iron in the Mountains Style', 4);
        $this->create('Lord Hida\'s Grip', 2);
        $this->create('Lord Shiba\'s Valor', 2);
        $this->create('Soaring Slice');
        $this->create('Soul Sunder', 5);
        $this->create('Striking as Air');
        $this->create('Striking as Earth');
        $this->create('Striking as Fire');
        $this->create('Striking as Void', 5);
        $this->create('Striking as Water');
        $this->create('Tactical Assessment', 2);
        $this->create('Warrior\'s Resolve');
    }
}
