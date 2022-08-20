<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone;

use App\Models\Core\SourceBook;
use Illuminate\Database\Seeder;

final class SchoolSeeder extends Seeder
{


    public function run(SourceBook $sourceBook): void
    {
        (new Schools\CraneSeeder($sourceBook))->run();
    }
}
