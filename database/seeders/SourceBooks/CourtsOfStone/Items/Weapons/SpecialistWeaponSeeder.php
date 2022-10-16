<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Items\Weapons;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\WeaponData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class SpecialistWeaponSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Kamayari',
            7,
            (new Cost())->withKoku(8),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(2)
                ->withDamage(4)
                ->withDeadliness(3)
                ->withTwoHandedGrip('-'),
        );

        $this->create(
            'Kusarifundo',
            5,
            (new Cost())->withBu(4),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1)
                ->withDamage(2)
                ->withDeadliness(2)
                ->withOneHandedGrip('-')
                ->withTwoHandedGrip('Snaring'),
        );

        $this->create(
            'Kyoketsu Shoge',
            6,
            (new Cost())->withBu(3),
            (new WeaponData())
                ->withSkill('martial_arts_ranged')
                ->withRange(1, 2)
                ->withDamage(2)
                ->withDeadliness(3)
                ->withTwoHandedGrip('-'),
        );

        $this->create(
            'Shakuhachi',
            4,
            (new Cost())->withBu(3),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0)
                ->withDamage(3)
                ->withDeadliness(2)
                ->withOneHandedGrip('-')
                ->withTwoHandedGrip('Damage +1'),
        );

        $this->create(
            'Tekagi',
            5,
            (new Cost())->withBu(3),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0)
                ->withDamage(1)
                ->withDeadliness(3)
                ->withTwoHandedGrip('-'),
        );

        $this->create(
            'Tekken',
            4,
            (new Cost())->withBu(3),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0)
                ->withDamage(2)
                ->withDeadliness(3)
                ->withTwoHandedGrip('-'),
        );
    }
}
