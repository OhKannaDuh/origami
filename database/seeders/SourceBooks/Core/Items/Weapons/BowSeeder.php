<?php

namespace Database\Seeders\SourceBooks\Core\Items\Weapons;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\WeaponData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class BowSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Daikyu',
            6,
            (new Cost())->withKoku(6),
            (new WeaponData())
                ->withSkill('martial_arts_ranged')
                ->withRange(3, 5)
                ->withDamage(6)
                ->withDeadliness(4)
                ->withTwoHandedGrip('-'),
        );

        $this->create(
            'Horsebow',
            4,
            (new Cost())->withKoku(6),
            (new WeaponData())
                ->withSkill('martial_arts_ranged')
                ->withRange(2, 4)
                ->withDamage(4)
                ->withDeadliness(5)
                ->withTwoHandedGrip('-'),
        );

        $this->create(
            'Yumi',
            3,
            (new Cost())->withKoku(3),
            (new WeaponData())
                ->withSkill('martial_arts_ranged')
                ->withRange(2, 5)
                ->withDamage(5)
                ->withDeadliness(3)
                ->withTwoHandedGrip('-'),
        );
    }
}
