<?php

namespace Database\Seeders\SourceBooks\Core\Items\Weapons;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\WeaponData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class PolearmSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Bisento',
            8,
            (new Cost())->withKoku(15),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(2)
                ->withDamage(4)
                ->withDeadliness(6)
                ->withOneHandedGrip('Range 1')
                ->withTwoHandedGrip('Damage +2'),
        );

        $this->create(
            'Bo',
            2,
            (new Cost())->withBu(2),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1, 2)
                ->withDamage(6)
                ->withDeadliness(2)
                ->withTwoHandedGrip('-'),
        );

        $this->create(
            'Ji',
            6,
            (new Cost())->withKoku(7),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(2)
                ->withDamage(5)
                ->withDeadliness(2)
                ->withTwoHandedGrip('-'),
        );

        $this->create(
            'Naginata',
            8,
            (new Cost())->withKoku(10),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(2)
                ->withDamage(6)
                ->withDeadliness(6)
                ->withTwoHandedGrip('-'),
        );

        $this->create(
            'Trident',
            7,
            (new Cost())->withKoku(10),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(2)
                ->withDamage(4)
                ->withDeadliness(4)
                ->withTwoHandedGrip('-'),
        );

        $this->create(
            'Yari',
            3,
            (new Cost())->withKoku(5),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(2)
                ->withDamage(5)
                ->withDeadliness(3)
                ->withTwoHandedGrip('-'),
        );
    }
}
