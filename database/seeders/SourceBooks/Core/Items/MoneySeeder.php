<?php

namespace Database\Seeders\SourceBooks\Core\Items;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\SourceBooks\ItemSeeder;

final class MoneySeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create('Zeni', 1, (new Cost())->withZeni(1));
        $this->create('Bu', 1, (new Cost())->withBu(1));
        $this->create('Koku', 1, (new Cost())->withKoku(1));
    }
}
