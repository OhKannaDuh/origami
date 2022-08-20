<?php

namespace Database\Seeders\SourceBooks\Core\Advantages;

use Database\Seeders\SourceBooks\AdvantageSeeder;

final class DistinctionSeeder extends AdvantageSeeder
{


    public function run(): void
    {
        $this->create('Ally [Name]', 'water');
        $this->create('Ambidexterity', 'air');
        $this->create('Benten\'s Blessing', 'air');
        $this->create('Bishamon\'s Blessing', 'water');
        $this->create('Blackmail on [Name]', 'fire');
        $this->create('Blessed Lineage', 'void');
        $this->create('Blissful Betrothal', 'water');
        $this->create('Daikoku\'s Blessing', 'water');
        $this->create('Dangerous Allure', 'fire');
        $this->create('Ebisu\'s Blessing', 'earth');
        $this->create('Famously Honest', 'air');
        $this->create('Famously Lucky', 'void');
        $this->create('Famously Reliable', 'earth');
        $this->create('Famously Successful', 'fire');
        $this->create('Famously Wealthy', 'water');
        $this->create('Flexibility', 'water');
        $this->create('Fukurokujin\'s Blessing', 'fire');
        $this->create('Indomitable Will', 'earth');
        $this->create('Jurojin\'s Blessing', 'void');
        $this->create('Keen Balance', 'earth');
        $this->create('Keen Hearing', 'air');
        $this->create('Keen Sight', 'water');
        $this->create('Keen Smell', 'fire');
        $this->create('Karmic Tie', 'Void');
        $this->create('Kisshoten\'s Blessing', 'water');
        $this->create('Paragon of a Bushido Tenet (Compassion)', 'water');
        $this->create('Paragon of a Bushido Tenet (Courage)', 'fire');
        $this->create('Paragon of a Bushido Tenet (Courtesy)', 'air');
        $this->create('Paragon of a Bushido Tenet (Duty and Loyalty)', 'earth');
        $this->create('Paragon of a Bushido Tenet (Honor)', 'void');
        $this->create('Paragon of a Bushido Tenet (Rightesousness)', 'void');
        $this->create('Paragon of a Bushido Tenet (Sincerity)', 'void');
        $this->create('Precise Memory', 'earth');
        $this->create('Quick Reflexes', 'fire');
        $this->create('Seasoned', 'void');
        $this->create('Sixth Sense', 'void');
        $this->create('Small Stature', 'air');
        $this->create('Subtle Observer', 'air');
        $this->create('Support of [One Group]', 'water');

        $this->create('Talented Herbalist', 'earth');
    }
}
