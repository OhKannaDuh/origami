<?php

namespace Database\Seeders\SourceBooks\Core;

use App\Models\Core\AdvantageType;
use App\Models\Core\SourceBook;
use Illuminate\Database\Seeder;

final class AdvantageSeeder extends Seeder
{


    public function run(SourceBook $sourceBook): void
    {
        (new Advantages\DistinctionSeeder(
            $sourceBook,
            AdvantageType::query()->where('key', 'distinction')->first(['id']),
        ))->run();

        (new Advantages\PassionSeeder(
            $sourceBook,
            AdvantageType::query()->where('key', 'passion')->first(['id']),
        ))->run();
    }
}
