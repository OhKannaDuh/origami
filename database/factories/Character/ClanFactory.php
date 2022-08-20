<?php

namespace Database\Factories\Character;

use App\Models\Core\Ring;
use App\Models\Core\Skill;
use App\Models\Core\SourceBook;
use App\StringHelper;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character\Clan>
 */
class ClanFactory extends Factory
{


    public function definition(): array
    {
        $name = StringHelper::random(32);
        return [
            'source_book_id' => $this->firstOrCreate(SourceBook::class)->getKey(),
            'ring_id' => $this->firstOrCreate(Ring::class)->getKey(),
            'skill_id' => $this->firstOrCreate(Skill::class)->getKey(),
            'key' => StringHelper::key($name),
            'name' => $name,
            'status' => rand(30, 50),
            'is_major' => rand(1, 2) === 1,
            'description' => fake()->sentence(),
        ];
    }
}
