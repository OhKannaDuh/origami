<?php

namespace Database\Factories\Core;

use App\StringHelper;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Core\SchoolType>
 */
class SchoolTypeFactory extends Factory
{


    public function definition()
    {
        $name = StringHelper::random(32);
        return [
            'key' => StringHelper::key($name),
            'name' => $name,
        ];
    }
}
