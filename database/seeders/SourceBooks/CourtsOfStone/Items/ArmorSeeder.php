<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Items;

use Database\Seeders\Helpers\ArmorData;
use Database\Seeders\Helpers\Cost;
use Database\Seeders\SourceBooks\ItemSeeder;

final class ArmorSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Firefighter\'s Coat',
            4,
            (new Cost())->withBu(6),
            (new ArmorData())
                ->withPhysical(2),
        );

        $this->create(
            'Stealth Clothing',
            7,
            (new Cost())->withBu(4),
            (new ArmorData())
                ->withPhysical(2),
        );
    }
}
