<?php

namespace Database\Seeders\SourceBooks\Shadowlands;

use App\Models\Core\SourceBook;
use Illuminate\Database\Seeder;

final class SchoolSeeder extends Seeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->callWith([
            Schools\AsakoInquisitorSchoolSeeder::class,
            Schools\KakitaSwordsmithSchoolSeeder::class,
            Schools\KitsuMedicSchoolSeeder::class,
            Schools\KuniWardenSchoolSeeder::class,
            Schools\MirumotoTaoistBladeSchoolSeeder::class,
            Schools\MotoAvengerSchoolSeeder::class,
            Schools\ToritakaPhantomHunterSchoolSeeder::class,
            Schools\YogoPreserverSchoolSeeder::class,
        ], [
            'sourceBook' => $sourceBook,
        ]);
    }
}
