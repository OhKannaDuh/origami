<?php

namespace Database\Seeders\SourceBooks\Core\Techniques\Invocations;

use Database\Seeders\SourceBooks\TechniqueSeeder;

final class AirInvocationsSeeder extends TechniqueSeeder
{


    public function run(): void
    {
        $this->create('Blessed Wind', 1);
        $this->create('By the light of the Lord Moon', 1);
        $this->create('Call Upon the Wind', 2);
        $this->create('Cloak of Night');
        $this->create('False Realm of the Fox Spirits', 4);
        $this->create('Grasp of the Air Dragon', 3);
        $this->create('Mask of Wind', 2);
        $this->create('Nature\'s Touch');
        $this->create('Rise, Air', 4);
        $this->create('Secrets on the Wind', 2);
        $this->create('Summon Fog', 2);
        $this->create('Tempest of Air');
        $this->create('Token of Memory');
        $this->create('Vapor of Nightmares', 3);
        $this->create('Wrath of Kaze-no-Kami', 5);
        $this->create('Yari of Air');
    }
}
