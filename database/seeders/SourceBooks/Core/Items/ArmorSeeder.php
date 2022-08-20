<?php

namespace Database\Seeders\SourceBooks\Core\Items;

use Database\Seeders\Helpers\ArmorData;
use Database\Seeders\Helpers\Cost;
use Database\Seeders\SourceBooks\ItemSeeder;

final class ArmorSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Sleeping Gard',
            2,
            (new Cost())->withKoku(1),
        );


        $this->create(
            'Common Clothes',
            1,
            (new Cost())->withBu(1),
            (new ArmorData())
                ->withPhysical(1),
        );


        $this->create(
            'Ceremonial Clothes',
            4,
            (new Cost())->withKoku(1),
            (new ArmorData())
                ->withPhysical(1),
        );


        $this->create(
            'Sanctified Robes',
            7,
            (new Cost())->withKoku(7),
            (new ArmorData())
                ->withPhysical(1)
                ->withSupernatural(3),
        );


        $this->create(
            'Traveling Clothes',
            2,
            (new Cost())->withBu(2),
            (new ArmorData())
                ->withPhysical(2),
        );


        $this->create(
            'Concealed Armor',
            1,
            (new Cost())->withKoku(5),
            (new ArmorData())
                ->withPhysical(2),
        );


        $this->create(
            'Ashigaru Armor',
            3,
            (new Cost())->withKoku(5),
            (new ArmorData())
                ->withPhysical(3),
        );


        $this->create(
            'Lacquered Armor',
            6,
            (new Cost())->withKoku(25),
            (new ArmorData())
                ->withPhysical(4),
        );


        $this->create(
            'Plated Armor',
            8,
            (new Cost())->withKoku(40),
            (new ArmorData())
                ->withPhysical(5),
        );


        $this->create('Inconspicuous Garb', 1, new Cost(), new ArmorData());
    }
}
