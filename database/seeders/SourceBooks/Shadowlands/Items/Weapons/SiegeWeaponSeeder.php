<?php

namespace Database\Seeders\SourceBooks\Shadowlands\Items\Weapons;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\WeaponData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class SiegeWeaponSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Ballista',
            7,
            (new Cost())->withKoku(60),
            (new WeaponData())
                ->withSkill('martial_arts_ranged')
                ->withRange(3, 5)
                ->withDamage(14)
                ->withDeadliness(8)
                ->withTwoHandedGrip('-'),
        );

        $this->create(
            'O-Gata Dohou',
            7,
            (new Cost())->withKoku(120),
            (new WeaponData())
                ->withSkill('martial_arts_ranged')
                ->withRange(4, 5)
                ->withDamage(16)
                ->withDeadliness(6)
                ->withTwoHandedGrip('-'),
        );
    }
}
