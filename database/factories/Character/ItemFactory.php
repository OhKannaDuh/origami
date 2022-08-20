<?php

namespace Database\Factories\Character;

use App\Models\Core\ItemSubtype;
use App\Models\Core\SourceBook;
use App\StringHelper;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character\Item>
 */
class ItemFactory extends Factory
{


    public function definition(): array
    {
        $name = StringHelper::random(32);
        return [
            'source_book_id' => $this->firstOrCreate(SourceBook::class)->getKey(),
            'item_subtype_id' => $this->firstOrCreate(ItemSubtype::class)->getKey(),
            'key' => StringHelper::key($name),
            'name' => $name,
            'description' => fake()->sentence(),
            'data' => [],
            'cost' => [],
            'rarity' => rand(1, 10),
        ];
    }
}
