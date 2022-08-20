<?php

namespace Database\Seeders\SourceBooks\Shadowlands\Items;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\SourceBooks\ItemSeeder;

final class PersonalEffectsSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create('Climbing Kit', 3, (new Cost())->withBu(2));
        $this->create('Engineer\'s Kit', 3, (new Cost())->withBu(3));
        $this->create('Sapper\'s Kit', 3, (new Cost())->withBu(1));
        $this->create('Smithy\'s Kit', 3, (new Cost())->withBu(3));
        $this->create('Smoke Arrows', 4, (new Cost())->withBu(3));
        $this->create('Spyglass', 5, (new Cost())->withKoku(2));
        $this->create('Taketaba', 4, (new Cost())->withBu(4));
        $this->create('Tate', 3, (new Cost())->withBu(3));
    }
}
