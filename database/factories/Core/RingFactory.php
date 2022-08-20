<?php

namespace Database\Factories\Core;

use App\StringHelper;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Core\Ring>
 */
class RingFactory extends Factory
{


    public function definition()
    {
        $name = StringHelper::random(8);
        return [
            'key' => StringHelper::key($name),
            'name' => $name,
        ];
    }
}
