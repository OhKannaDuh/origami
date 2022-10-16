<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone;

use App\Models\Core\SourceBook;
use Illuminate\Database\Seeder;

final class SchoolSeeder extends Seeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->callWith([
            Schools\BayushiDeathdealerSchoolSeeder::class,
            Schools\DaidojiSpymasterSchoolSeeder::class,
            Schools\DojiBureaucratSchoolSeeder::class,
            Schools\DojiBureaucratSchoolSeeder::class,
            Schools\IkomaShadowSchoolSeeder::class,
            Schools\MercenaryNinjaTrainingSeeder::class,
            Schools\ShibaArtistSchoolSeeder::class,
            Schools\ShikaMatchmakerSchoolSeeder::class,
            Schools\ShikaSpeardancerSchoolSeeder::class,
            Schools\TogashiChroniclerSchoolSeeder::class,
            Schools\YasukiYojimboSchoolSeeder::class,
        ], [
            'sourceBook' => $sourceBook,
        ]);
    }
}
