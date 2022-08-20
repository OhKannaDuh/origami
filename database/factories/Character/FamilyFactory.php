<?php

namespace Database\Factories\Character;

use App\Models\Character\Clan;
use App\Models\Core\Ring;
use App\Models\Core\Skill;
use App\Models\Core\SourceBook;
use App\StringHelper;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character\Family>
 */
class FamilyFactory extends Factory
{


    public function definition(): array
    {
        $name = StringHelper::random(32);
        return [
            'source_book_id' => $this->firstOrCreate(SourceBook::class)->getKey(),
            'clan_id' => $this->firstOrCreate(Clan::class)->getKey(),
            'ring_choice_one_id' => $this->firstOrCreate(Ring::class)->getKey(),
            'ring_choice_two_id' => $this->firstOrCreate(Ring::class)->getKey(),
            'skill_one_id' => $this->firstOrCreate(Skill::class)->getKey(),
            'skill_two_id' => $this->firstOrCreate(Skill::class)->getKey(),
            'key' => StringHelper::key($name),
            'name' => $name,
            'glory' => rand(30, 50),
            'starting_wealth' => rand(5, 10),
            'description' => fake()->sentence(),
        ];
    }
}
