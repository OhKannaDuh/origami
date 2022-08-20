<?php

namespace Database\Seeders\SourceBooks\Core\Items\Weapons;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\WeaponData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class BluntWeapons extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Club',
            1,
            (new Cost())->withBu(1),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0, 1)
                ->withDamage(5)
                ->withDeadliness(2)
                ->withOneHandedGrip('-')
                ->withTwoHandedGrip('Damage +1'),
        );

        $this->create(
            'Hammer',
            4,
            (new Cost())->withBu(2),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0, 1)
                ->withDamage(5)
                ->withDeadliness(2)
                ->withOneHandedGrip('-')
                ->withTwoHandedGrip('Damage +2'),
        );

        $this->create(
            'Kiseru',
            5,
            (new Cost())->withKoku(1),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0)
                ->withDamage(2)
                ->withDeadliness(2)
                ->withOneHandedGrip('-'),
        );

        $this->create(
            'Otsuchi',
            8,
            (new Cost())->withKoku(30),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1)
                ->withDamage(8)
                ->withDeadliness(3)
                ->withTwoHandedGrip('-'),
        );

        $this->create(
            'Tetsubo',
            5,
            (new Cost())->withKoku(20),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1, 2)
                ->withDamage(7)
                ->withDeadliness(3)
                ->withTwoHandedGrip('-'),
        );
    }
}
