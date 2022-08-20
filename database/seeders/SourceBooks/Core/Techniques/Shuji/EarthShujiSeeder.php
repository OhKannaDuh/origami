<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Shuji;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class EarthShujiSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Ancestry Unearthed');
        $this->create('Civility Foremost', 2);
        $this->create('Honest Assessment');
        $this->create('Pillar of Calm', 4);
        $this->create('Stonewall Tactics');
        $this->create('Touchstone of Courage', 3);
        $this->create('The Immovable Hand of Peace', 5);
        $this->create('Weight of Duty');
    }
}
