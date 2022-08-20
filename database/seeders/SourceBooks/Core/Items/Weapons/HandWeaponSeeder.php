<?php

namespace Database\Seeders\SourceBooks\Core\Items\Weapons;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\WeaponData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class HandWeaponSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Jitte',
            5,
            (new Cost())->withBu(5),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0)
                ->withDamage(3)
                ->withDeadliness(2)
                ->withOneHandedGrip('-'),
        );

        $this->create(
            'Knife',
            1,
            (new Cost())->withKoku(1),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0)
                ->withDamage(2)
                ->withDeadliness(3)
                ->withOneHandedGrip('-')
                ->withTwoHandedGrip('Deadliness +2'),
        );

        $this->create(
            'Nunchaku',
            6,
            (new Cost())->withKoku(1),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0, 1)
                ->withDamage(4)
                ->withDeadliness(2)
                ->withOneHandedGrip('-')
                ->withTwoHandedGrip('Snaring'),
        );

        $this->create(
            'Tessen',
            7,
            (new Cost())->withKoku(15),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0, 1)
                ->withDamage(4)
                ->withDeadliness(3)
                ->withOneHandedGrip('-'),
        );
    }
}
