<?php

namespace Database\Factories\Core;

use App\StringHelper;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Core\SourceBook>
 */
class SourceBookFactory extends Factory
{


    public function definition()
    {
        $name = StringHelper::random(64);
        return [
            'key' => StringHelper::key($name),
            'name' => $name,
            'image' => fake()->imageUrl(),
        ];
    }
}
