<?php

namespace Database\Seeders\SourceBooks\Core;

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
            'ring_id' => Ring::query()->where('key', 'earth')->first(['id'])->getKey(),
            'skill_id' => Skill::query()->where('key', 'fitness')->first(['id'])->getKey(),
            'key' => 'crab',
            'name' => 'Crab',
            'status' => 30,
            'description' => '_',
            'is_major' => true,
        ]);

        Clan::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'ring_id' => Ring::query()->where('key', 'air')->first(['id'])->getKey(),
            'skill_id' => Skill::query()->where('key', 'culture')->first(['id'])->getKey(),
            'key' => 'crane',
            'name' => 'Crane',
            'status' => 35,
            'description' => '_',
            'is_major' => true,
        ]);

        Clan::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'ring_id' => Ring::query()->where('key', 'fire')->first(['id'])->getKey(),
            'skill_id' => Skill::query()->where('key', 'meditation')->first(['id'])->getKey(),
            'key' => 'dragon',
            'name' => 'Dragon',
            'status' => 30,
            'description' => '_',
            'is_major' => true,
        ]);

        Clan::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'ring_id' => Ring::query()->where('key', 'water')->first(['id'])->getKey(),
            'skill_id' => Skill::query()->where('key', 'tactics')->first(['id'])->getKey(),
            'key' => 'lion',
            'name' => 'Lion',
            'status' => 35,
            'description' => '_',
            'is_major' => true,
        ]);

        Clan::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'ring_id' => Ring::query()->where('key', 'void')->first(['id'])->getKey(),
            'skill_id' => Skill::query()->where('key', 'theology')->first(['id'])->getKey(),
            'key' => 'phoenix',
            'name' => 'Phoenix',
            'status' => 30,
            'description' => '_',
            'is_major' => true,
        ]);

        Clan::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'ring_id' => Ring::query()->where('key', 'air')->first(['id'])->getKey(),
            'skill_id' => Skill::query()->where('key', 'skulduggery')->first(['id'])->getKey(),
            'key' => 'scorpion',
            'name' => 'Scorpion',
            'status' => 35,
            'description' => '_',
            'is_major' => true,
        ]);

        Clan::query()->create([
            'source_book_id' => $sourceBook->getKey(),
            'ring_id' => Ring::query()->where('key', 'water')->first(['id'])->getKey(),
            'skill_id' => Skill::query()->where('key', 'survival')->first(['id'])->getKey(),
            'key' => 'unicorn',
            'name' => 'Unicorn',
            'status' => 30,
            'description' => '_',
            'is_major' => true,
        ]);
    }
}
