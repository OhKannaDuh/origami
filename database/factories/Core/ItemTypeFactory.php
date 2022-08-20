<?php

namespace Database\Factories\Core;

use App\StringHelper;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Core\ItemType>
 */
class ItemTypeFactory extends Factory
{


    public function definition()
    {
        $name = StringHelper::random(32);
        $name = StringHelper::random(32);
        return [
            'key' => StringHelper::key($name),
            'name' => $name,
        ];
    }
}
