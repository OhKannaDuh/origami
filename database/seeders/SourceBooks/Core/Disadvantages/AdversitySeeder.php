<?php

namespace Database\Seeders\SourceBooks\Core\Disadvantages;

use Database\Seeders\SourceBooks\DisadvantageSeeder;

final class AdversitySeeder extends DisadvantageSeeder
{


    public function run(): void
    {
        $this->create('Benten\'s Curse', 'air');
        $this->create('Bishamon\'s Curse', 'water');
        $this->create('Bitter Betrothal', 'water');
        $this->create('Blackmailed By [Character\'s Name]', 'air');
        $this->create('Blindness', 'water');
        $this->create('Bluntness', 'air');
        $this->create('Cognitive Lapses', 'void');
        $this->create('Daikoku\'s Curse', 'water');
        $this->create('Damaged Heart or Organ', 'earth');
        $this->create('Deafness', 'air');
        $this->create('Discomfiting Countenance', 'air');
        $this->create('Disdain for a Bushido Tenet (Compassion)', 'water');
        $this->create('Disdain for a Bushido Tenet (Courage)', 'fire');
        $this->create('Disdain for a Bushido Tenet (Courtesy)', 'air');
        $this->create('Disdain for a Bushido Tenet (Duty and Loyalty)', 'earth');
        $this->create('Disdain for a Bushido Tenet (Honor)', 'void');
        $this->create('Disdain for a Bushido Tenet (Rightesousness)', 'void');
        $this->create('Disdain for a Bushido Tenet (Sincerity)', 'void');
        $this->create('Ebisu\'s Curse', 'earth');
        $this->create('Fractured Spine', 'earth');
        $this->create('Fukurokujin\'s Curse', 'fire');
        $this->create('Gaijin name, culture or appearance', 'fire');
        $this->create('Haunting', 'void');
        $this->create('Incurable Illness', 'earth');
        $this->create('Jurojin\'s Curse', 'void');
        $this->create('Kisshoten\'s Curse', 'water');
        $this->create('Lost arm or Lost hand', 'fire');
        $this->create('Lost Eye', 'water');
        $this->create('Lost Fingers', 'fire');
        $this->create('Lost Leg', 'water');
        $this->create('Lost Memories', 'void');
        $this->create('Maimed Arm', 'fire');
        $this->create('Maimed Visage', 'air');
        $this->create('Momoku', 'void');
        $this->create('Muteness', 'air');
        $this->create('Nerve Damage', 'air');
        $this->create('Scorn of [One Group]', 'water');
        $this->create('Shadowlands Taint (Air)', 'air');
        $this->create('Shadowlands Taint (Earth)', 'earth');
        $this->create('Shadowlands Taint (Fire)', 'fire');
        $this->create('Shadowlands Taint (Void)', 'void');
        $this->create('Shadowlands Taint (Water)', 'water');
        $this->create('Sworn Enemy', 'earth');
        $this->create('Whispers of Cruelty', 'earth');
        $this->create('Whispers of Doom', 'void');
        $this->create('Whispers of Failure', 'fire');
        $this->create('Whispers of Poverty', 'water');
        $this->create('Whispers of Treachery', 'air');
    }
}
