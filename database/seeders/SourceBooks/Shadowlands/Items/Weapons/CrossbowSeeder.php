<?php

namespace Database\Seeders\SourceBooks\Shadowlands\Items\Weapons;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\WeaponData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class CrossbowSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Doom Crossbow',
            10,
            (new Cost())->withKoku(80),
            (new WeaponData())
                ->withSkill('martial_arts_ranged')
                ->withRange(3, 5)
                ->withDamage(8)
                ->withDeadliness(6)
                ->withTwoHandedGrip('-'),
        );

        $this->create(
            'Kaiu no Oyumi',
            8,
            (new Cost())->withKoku(60),
            (new WeaponData())
                ->withSkill('martial_arts_ranged')
                ->withRange(2, 5)
                ->withDamage(7)
                ->withDeadliness(3)
                ->withTwoHandedGrip('-'),
        );

        $this->create(
            'Storm Bow',
            9,
            (new Cost())->withKoku(60),
            (new WeaponData())
                ->withSkill('martial_arts_ranged')
                ->withRange(1, 4)
                ->withDamage(4)
                ->withDeadliness(3)
                ->withTwoHandedGrip('-'),
        );
    }
}
