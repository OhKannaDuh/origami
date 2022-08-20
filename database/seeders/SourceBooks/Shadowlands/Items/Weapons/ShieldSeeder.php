<?php

namespace Database\Seeders\SourceBooks\Shadowlands\Items\Weapons;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\WeaponData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class ShieldSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Sode',
            8,
            (new Cost())->withKoku(8),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0)
                ->withDamage(1)
                ->withDeadliness(1)
                ->withOneHandedGrip('(Shoulder)'),
        );

        $this->create(
            'Large Shield',
            8,
            (new Cost())->withKoku(10),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0)
                ->withDamage(3)
                ->withDeadliness(2)
                ->withOneHandedGrip(''),
        );

        $this->create(
            'Small Shield',
            8,
            (new Cost())->withKoku(6),
            (new WeaponData())
                ->withSkill('martial_arts_melee')
                ->withRange(0)
                ->withDamage(2)
                ->withDeadliness(2)
                ->withOneHandedGrip(''),
        );
    }
}
