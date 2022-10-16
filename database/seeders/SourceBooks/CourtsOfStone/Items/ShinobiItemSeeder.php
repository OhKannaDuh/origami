<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Items;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\SourceBooks\ItemSeeder;

final class ShinobiItemSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create('Amigasa', 2, (new Cost())->withZeni(4));
        $this->create('Bamboo Cane', 6, (new Cost())->withBu(6));
        $this->create('Demon Mask', 5, (new Cost())->withKoku(1));
        $this->create('Disguise Kit', 6, (new Cost())->withBu(9));
        $this->create('Herbal Medicines', 5, (new Cost())->withBu(1));
        $this->create('Invisible Ink', 8, (new Cost())->withBu(6));
        $this->create('Makibishi', 5, (new Cost())->withBu(1));
        $this->create('Metsubuushi', 5, (new Cost())->withZeni(6));
        $this->create('Mizugumo (Water Spider)', 6, (new Cost())->withBu(3));
        $this->create('Modified Scabbard', 6, (new Cost())->withKoku(2));
        $this->create('Opening and Closing Tools', 4, (new Cost())->withBu(5));
        $this->create('Portable Boat', 2, (new Cost())->withKoku(3));
        $this->create('Rope Ladder', 3, (new Cost())->withBu(2));
        $this->create('Sekihitsu', 1, (new Cost())->withZeni(3));
        $this->create('Sokutoki', 4, (new Cost())->withBu(2));
        $this->create('Tenugui', 2, (new Cost())->withZeni(3));
        $this->create('Uchitake', 3, (new Cost())->withZeni(12));
    }
}
