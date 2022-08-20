<?php

namespace Database\Seeders\SourceBooks\EmeraldEmpire;

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
            'ring_id' => Ring::query()->where('key', 'air')->first(['id'])->getKey(),
            'skill_id' => Skill::query()->where('key', 'government')->first(['id'])->getKey(),
            'key' => 'imperial',
            'name' => 'Imperial',
            'status' => 40,
            'description' => '_',
            'is_major' => true,
        ]);
    }
}
