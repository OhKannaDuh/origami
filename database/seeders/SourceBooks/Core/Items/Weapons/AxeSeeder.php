<?php

namespace Database\Seeders\SourceBooks\Core\Items\Weapons;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\WeaponData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class AxeSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Masakari',
            5,
            (new Cost())->withBu(3),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0, 1)
                ->withDamage(3)
                ->withDeadliness(4)
                ->withOneHandedGrip('-')
                ->withTwoHandedGrip('Deadliness +2'),
        );

        $this->create(
            'Ono',
            7,
            (new Cost())->withKoku(5),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1, 2)
                ->withDamage(5)
                ->withDeadliness(6)
                ->withTwoHandedGrip('-'),
        );
    }
}
