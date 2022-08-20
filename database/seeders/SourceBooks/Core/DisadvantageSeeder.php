<?php

namespace Database\Seeders\SourceBooks\Core;

use App\Models\Core\DisadvantageType;
use App\Models\Core\SourceBook;
use Illuminate\Database\Seeder;

final class DisadvantageSeeder extends Seeder
{


    public function run(SourceBook $sourceBook): void
    {
        (new Disadvantages\AdversitySeeder(
            $sourceBook,
            DisadvantageType::query()->where('key', 'adversity')->first(['id']),
        ))->run();

        (new Disadvantages\AnxietySeeder(
            $sourceBook,
            DisadvantageType::query()->where('key', 'anxiety')->first(['id']),
        ))->run();
    }
}
