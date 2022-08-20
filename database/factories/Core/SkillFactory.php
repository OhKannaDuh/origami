<?php

namespace Database\Factories\Core;

use App\Models\Core\SkillGroup;
use App\StringHelper;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Core\Skill>
 */
class SkillFactory extends Factory
{


    public function definition()
    {
        $name = StringHelper::random(32);
        return [
            'skill_group_id' => $this->firstOrCreate(SkillGroup::class)->getKey(),
            'key' => StringHelper::key($name),
            'name' => $name,
            'description' => fake()->sentence(),
        ];
    }
}
