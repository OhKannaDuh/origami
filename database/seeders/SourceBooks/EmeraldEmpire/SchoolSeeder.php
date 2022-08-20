<?php

namespace Database\Seeders\SourceBooks\EmeraldEmpire;

use App\Models\Core\SourceBook;
use Illuminate\Database\Seeder;

final class SchoolSeeder extends Seeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->callWith([
            Schools\MiyaCartographerSchoolSeeder::class,
            Schools\MiyaHeraldSchoolSeeder::class,
            Schools\OtomoSchemerSchoolSeeder::class,
            Schools\SeppenAstrologerSchoolSeeder::class,
            Schools\SeppenPalaceGuardSchoolSeeder::class,
            Schools\FortunistMonkOrderSeeder::class,
            Schools\ShinseistMonkOrderSeeder::class,
            Schools\KitsuneImpersonatorTraditionSeeder::class,
            Schools\KolatSaboteurConspiracySeeder::class,
        ], [
            'sourceBook' => $sourceBook,
        ]);
    }
}
