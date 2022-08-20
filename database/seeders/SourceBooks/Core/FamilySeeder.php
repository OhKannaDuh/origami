<?php

namespace Database\Seeders\SourceBooks\Core;

use App\Models\Character\Clan;
use App\Models\Core\SourceBook;
use Illuminate\Database\Seeder;

final class FamilySeeder extends Seeder
{


    public function run(SourceBook $sourceBook): void
    {
        (new Families\CrabSeeder(
            $sourceBook,
            Clan::query()->where('key', 'crab')->first(['id']),
        ))->run();

        (new Families\CraneSeeder(
            $sourceBook,
            Clan::query()->where('key', 'crane')->first(['id']),
        ))->run();

        (new Families\DragonSeeder(
            $sourceBook,
            Clan::query()->where('key', 'dragon')->first(['id']),
        ))->run();

        (new Families\LionSeeder(
            $sourceBook,
            Clan::query()->where('key', 'lion')->first(['id']),
        ))->run();

        (new Families\PhoenixSeeder(
            $sourceBook,
            Clan::query()->where('key', 'phoenix')->first(['id']),
        ))->run();

        (new Families\ScorpionSeeder(
            $sourceBook,
            Clan::query()->where('key', 'scorpion')->first(['id']),
        ))->run();

        (new Families\UnicornSeeder(
            $sourceBook,
            Clan::query()->where('key', 'unicorn')->first(['id']),
        ))->run();
    }
}
