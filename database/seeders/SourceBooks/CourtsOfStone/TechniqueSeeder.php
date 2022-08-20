<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone;

use App\Models\Character\Technique;
use App\Models\Core\SourceBook;
use App\Models\Core\TechniqueSubtype;
use Illuminate\Database\Seeder;

final class TechniqueSeeder extends Seeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->execute(Techniques\RitualSeeder::class, 'rituals', $sourceBook);

        $this->execute(Techniques\NinjutsuSeeder::class, 'ninjutsu', $sourceBook);
    }


    private function execute(string $class, string $key, SourceBook $sourceBook): void
    {
        (new $class(
            $sourceBook,
            TechniqueSubtype::query()->where('key', $key)->first(['id']),
        ))->run();
    }
}
