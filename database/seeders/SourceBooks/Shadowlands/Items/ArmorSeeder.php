<?php

namespace Database\Seeders\SourceBooks\Shadowlands\Items;

use Database\Seeders\Helpers\ArmorData;
use Database\Seeders\Helpers\Cost;
use Database\Seeders\SourceBooks\ItemSeeder;

final class ArmorSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'O-yoroi',
            8,
            (new Cost())->withKoku(60),
            (new ArmorData())
                ->withPhysical(6),
        );

        $this->create(
            'Tatami Gusoku',
            4,
            (new Cost())->withKoku(7),
            (new ArmorData())
                ->withPhysical(3),
        );

        $this->create(
            'Tosei-Gusoku',
            8,
            (new Cost())->withKoku(50),
            (new ArmorData())
                ->withPhysical(4),
        );
    }
}
