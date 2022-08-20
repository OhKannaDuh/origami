<?php

namespace Database\Seeders\SourceBooks\Shadowlands\Items\Weapons;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\WeaponData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class SwordSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Flyssa',
            8,
            (new Cost())->withKoku(15),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1)
                ->withDamage(4)
                ->withDeadliness(4)
                ->withOneHandedGrip('-')
                ->withTwoHandedGrip('Razor-Edged'),
        );

        $this->create(
            'Kabutowari',
            7,
            (new Cost())->withKoku(6),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0, 1)
                ->withDamage(3)
                ->withDeadliness(3)
                ->withOneHandedGrip('-'),
        );

        $this->create(
            'Tekkan',
            8,
            (new Cost())->withKoku(50),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(1, 2)
                ->withDamage(4)
                ->withDeadliness(3)
                ->withOneHandedGrip('Cumbersome')
                ->withOneHandedGrip('Damage +2'),
        );
    }
}
