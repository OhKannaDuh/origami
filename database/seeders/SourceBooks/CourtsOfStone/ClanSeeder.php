<?php

namespace Database\Seeders\SourceBooks\CourtsOfStone;

use App\Models\Character\Clan;
use App\Models\Core\Ring;
use App\Models\Core\Skill;
use App\Models\Core\SourceBook;
use Illuminate\Database\Seeder;

final class ClanSeeder extends Seeder
{


    public function run(SourceBook $sourceBook): void
    {
        // Clan::query()->create([
        //     'source_book_id' => $sourceBook->getKey(),
        //     'ring_id' => Ring::query()->where('key', 'earth')->first(['id'])->getKey(),
        //     'skill_id' => Skill::query()->where('key', 'fitness')->first(['id'])->getKey(),
        //     'key' => 'deer',
        //     'name' => 'Deer',
        //     'status' => 30,
        //     'description' => '_',
        // ]);
    }
}
