<?php

namespace Database\Factories\Core;

use App\StringHelper;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Core\AdvantageType>
 */
class AdvantageTypeFactory extends Factory
{


    public function definition(): array
    {
        $name = StringHelper::random(32);
        return [
            'key' => StringHelper::key($name),
            'name' => $name,
        ];
    }
}
