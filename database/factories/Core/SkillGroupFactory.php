<?php

namespace Database\Factories\Core;

use App\StringHelper;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Core\SkillGroup>
 */
class SkillGroupFactory extends Factory
{


    public function definition()
    {
        $name = StringHelper::random(8);
        return [
            'key' => StringHelper::key($name),
            'name' => $name,
            'description' => fake()->sentence(),
        ];
    }
}
