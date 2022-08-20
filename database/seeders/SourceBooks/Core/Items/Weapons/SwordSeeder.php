<?php

namespace Database\Seeders\SourceBooks\Core\Items\Weapons;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\WeaponData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class SwordSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Bokken',
            3,
            (new Cost())->withBu(1),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1)
                ->withDamage(3)
                ->withDeadliness(3)
                ->withOneHandedGrip('-')
                ->withTwoHandedGrip('Damage +2'),
        );

        $this->create(
            'Chokuto',
            7,
            (new Cost())->withKoku(20),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0, 1)
                ->withDamage(4)
                ->withDeadliness(5)
                ->withOneHandedGrip('-'),
        );

        $this->create(
            'Dao',
            6,
            (new Cost())->withKoku(15),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1)
                ->withDamage(3)
                ->withDeadliness(5)
                ->withOneHandedGrip('-'),
        );

        $this->create(
            'Gao',
            7,
            (new Cost())->withKoku(15),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1)
                ->withDamage(4)
                ->withDeadliness(3)
                ->withOneHandedGrip('-'),
        );

        $this->create(
            'Jian',
            7,
            (new Cost())->withKoku(15),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0, 1)
                ->withDamage(4)
                ->withDeadliness(4)
                ->withOneHandedGrip('-')
                ->withTwoHandedGrip('Deadlioness +1'),
        );

        $this->create(
            'Katana',
            7,
            (new Cost())->withKoku(20),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1)
                ->withDamage(4)
                ->withDeadliness(5)
                ->withOneHandedGrip('-')
                ->withTwoHandedGrip('Deadlioness +2'),
        );

        $this->create(
            'Nodachi',
            8,
            (new Cost())->withKoku(20),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1, 2)
                ->withDamage(5)
                ->withDeadliness(6)
                ->withTwoHandedGrip('-'),
        );

        $this->create(
            'Scimitar',
            8,
            (new Cost())->withKoku(20),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1)
                ->withDamage(4)
                ->withDeadliness(5)
                ->withOneHandedGrip('-'),
        );

        $this->create(
            'Wakizashi',
            7,
            (new Cost())->withKoku(15),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0, 1)
                ->withDamage(3)
                ->withDeadliness(5)
                ->withOneHandedGrip('-')
                ->withTwoHandedGrip('Deadlioness +2'),
        );

        $this->create(
            'Zanbato',
            8,
            (new Cost())->withKoku(40),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1, 2)
                ->withDamage(5)
                ->withDeadliness(6)
                ->withtwoHandedGrip('-'),
        );
    }
}
