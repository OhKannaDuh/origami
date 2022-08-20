<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Shuji;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class VoidShujiSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('All Arts Are One', 3);
        $this->create('A Samurai\'s Fate', 4);
        $this->create('Courtier\'s Resolve');
        $this->create('Lady Doji\'s Decree', 2);
        $this->create('Lady Shinjo\'s Speed', 2);
        $this->create('Lord Akodo\'s Roar', 2);
        $this->create('Lord Bayushi\'s Whispers', 2);
        $this->create('Lord Togashi\'s Insight', 2);
        $this->create('Rouse the Soul', 5);
    }
}
