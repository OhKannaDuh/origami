<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone;

use App\Models\Core\ItemSubtype;
use App\Models\Core\SourceBook;
use Illuminate\Database\Seeder;

final class ItemSeeder extends Seeder
{


    public function run(SourceBook $sourceBook): void
    {
        $this->execute(Items\ShinobiItemSeeder::class, 'shinobi_items', $sourceBook);
    }


    private function execute(string $class, string $key, SourceBook $sourceBook): void
    {
        (new $class(
            $sourceBook,
            ItemSubtype::query()->where('key', $key)->first(['id']),
        ))->run();
    }
}
