<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Items;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\SourceBooks\ItemSeeder;

final class PersonalEffectsSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create('Ceremonial Tea Set', 8, (new Cost())->withKoku(7));
        $this->create('Folding Fan', 3, (new Cost())->withKoku(1));
        $this->create('Makeup Kit', 2, (new Cost())->withBu(3));
        $this->create('Mari (ball)', 3, (new Cost())->withZeni(5));
        $this->create('Mono Imi Fuda (Taboo Plaque)', 6, (new Cost())->withBu(8));
        $this->create('Norimono (Palanquin)', 7, (new Cost())->withKoku(12));
        $this->create('Performers\' Boat', 6, (new Cost())->withKoku(20));
    }
}
