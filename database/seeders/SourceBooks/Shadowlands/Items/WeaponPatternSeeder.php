<?php

namespace Database\Seeders\SourceBooks\Shadowlands\Items;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\PatternData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class WeaponPatternSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Kakita Pattern',
            4,
            (new Cost()),
            (new PatternData())
                ->withDeadliness(1)
                ->withCost(3)
        );

        $this->create(
            'Kenzo Blade',
            4,
            (new Cost()),
            (new PatternData())
                ->withDeadliness(1)
                ->withDamage(-1)
                ->withCost(5)
        );

        $this->create(
            'Shirogane Jade Inlay (Weapon)',
            2,
            (new Cost()),
            (new PatternData())
                ->withDeadliness(-1)
                ->withCost(3)
        );
    }
}
