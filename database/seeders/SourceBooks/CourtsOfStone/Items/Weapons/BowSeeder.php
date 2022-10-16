<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Items\Weapons;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\WeaponData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class BowSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Folding Half-Bow',
            5,
            (new Cost())->withKoku(3),
            (new WeaponData())
                ->withSkill('martial_arts_ranged')
                ->withRange(2, 3)
                ->withDamage(4)
                ->withDeadliness(3)
                ->withTwoHandedGrip('-'),
        );
    }
}
