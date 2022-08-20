<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone\Items;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\SourceBooks\ItemSeeder;

final class ShinobiItemSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create('Disguise Kit', 6, (new Cost())->withBu(9));
        $this->create('Sokutoki', 4, (new Cost())->withBu(2));
        $this->create('Opening and Closing Tools', 4, (new Cost())->withBu(5));
    }
}
