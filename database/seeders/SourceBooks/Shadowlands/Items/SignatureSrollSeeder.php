<?php

namespace Database\Seeders\SourceBooks\Shadowlands\Items;

use Database\Seeders\Helpers\Cost;
use Database\Seeders\Helpers\ScrollData;
use Database\Seeders\SourceBooks\ItemSeeder;

final class SignatureSrollSeeder extends ItemSeeder
{


    public function run(): void
    {
        $this->create(
            'Ichi\'s Second Sight',
            10,
            (new Cost())->withKoku(60),
            (new ScrollData())
                ->withPrerequisites('Witch Hunter, Crab Clan')
                ->withCost(3)
        );

        $this->create(
            'Hasegawa\'s Denial',
            10,
            (new Cost())->withKoku(60),
            (new ScrollData())
                ->withPrerequisites('Crab Clan shugenja, school rank 3')
                ->withCost(3)
        );

        $this->create(
            'Maikara\'s Rebuke',
            10,
            (new Cost())->withKoku(60),
            (new ScrollData())
                ->withPrerequisites('Shugenja')
                ->withCost(3)
        );
    }
}
