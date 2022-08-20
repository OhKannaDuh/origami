<?php

namespace Database\Seeders\SourceBooks\Shadowlands;

use App\Models\Character\Clan;
use App\Models\Core\Ring;
use App\Models\Core\Skill;
use App\Models\Core\SourceBook;
use Illuminate\Database\Seeder;

final class ClanSeeder extends Seeder
{


    public function run(SourceBook $sourceBook): void
    {
        Clan::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'ring_id' => Ring::query()->where('key', 'void')->first(['id'])->getKey(),
            'skill_id' => Skill::query()->where('key', 'theology')->first(['id'])->getKey(),
            'key' => 'falcon',
            'name' => 'Falcon',
            'status' => 26,
            'description' => '_',
            'is_major' => false,
        ]);
    }
}
