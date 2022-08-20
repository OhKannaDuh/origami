<?php

namespace Database\Seeders\SourceBooks\Core\Items\Weapons;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\WeaponData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class CrossbowSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Oyumi',
            8,
            (new Cost())->withKoku(40),
            (new WeaponData())
                ->withSkill('martial_arts_ranged')
                ->withRange(2, 5)
                ->withDamage(7)
                ->withDeadliness(3)
                ->withTwoHandedGrip('-'),
        );
    }
}
