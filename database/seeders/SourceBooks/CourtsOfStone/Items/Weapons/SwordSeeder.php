<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Items\Weapons;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\WeaponData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class SwordSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Ninjato',
            7,
            (new Cost())->withKoku(12),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0, 1)
                ->withDamage(4)
                ->withDeadliness(4)
                ->withOneHandedGrip('-')
                ->withTwoHandedGrip('Deadliness +1'),
        );

        $this->create(
            'Shinobigatana',
            8,
            (new Cost())->withKoku(22),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0, 1)
                ->withDamage(4)
                ->withDeadliness(5)
                ->withOneHandedGrip('-')
                ->withTwoHandedGrip('Deadliness +1'),
        );
    }
}
