<?php

namespace Database\Seeders\SourceBooks\Shadowlands\Items\Weapons;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\WeaponData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class AxeSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Genno',
            5,
            (new Cost())->withKoku(1),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0, 1)
                ->withDamage(3)
                ->withDeadliness(3)
                ->withOneHandedGrip('-')
                ->withTwoHandedGrip('Damage +4'),
        );

        $this->create(
            'Tsuruhashi',
            4,
            (new Cost())->withBu(5),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1)
                ->withDamage(4)
                ->withDeadliness(3)
                ->withOneHandedGrip('Cumbersome')
                ->withTwoHandedGrip('Deadliness +2'),
        );
    }
}
