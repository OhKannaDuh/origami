<?php

namespace Database\Seeders\SourceBooks\Core\Items\Weapons;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\WeaponData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class SpecialistWeaponSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Blowgun',
            7,
            (new Cost())->withBu(5),
            (new WeaponData())
                ->withSkill('martial_arts_ranged')
                ->withRange(2, 3)
                ->withDamage(1)
                ->withDeadliness(2)
                ->withOneHandedGrip('-'),
        );

        $this->create(
            'Kama',
            4,
            (new Cost())->withKoku(1),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0, 1)
                ->withDamage(3)
                ->withDeadliness(3)
                ->withOneHandedGrip('-'),
        );

        $this->create(
            'Kusari-Gama',
            6,
            (new Cost())->withKoku(5),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1)
                ->withDamage(3)
                ->withDeadliness(3)
                ->withOneHandedGrip('-'),
        );

        $this->create(
            'Shuriken',
            6,
            (new Cost())->withKoku(1),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1)
                ->withDamage(2)
                ->withDeadliness(4)
                ->withOneHandedGrip('(stab or slash): - | (thrown): Martial Arts [Ranged], Range 1-3'),
        );
    }
}
