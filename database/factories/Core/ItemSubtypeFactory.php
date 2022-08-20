<?php

namespace Database\Factories\Core;

use App\Models\Core\ItemType;
use App\StringHelper;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Core\ItemSubtype>
 */
class ItemSubtypeFactory extends Factory
{


    public function definition()
    {
        $name = StringHelper::random(32);
        return [
            'item_type_id' => $this->firstOrCreate(ItemType::class)->getKey(),
            'key' => StringHelper::key($name),
            'name' => $name,
        ];
    }
}
