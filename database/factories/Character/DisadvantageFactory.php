<?php

namespace Database\Factories\Character;

use App\Models\Core\DisadvantageType;
use App\Models\Core\Ring;
use App\Models\Core\SourceBook;
use App\StringHelper;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character\Disadvantage>
 */
class DisadvantageFactory extends Factory
{


    public function definition(): array
    {
        $name = StringHelper::random(32);
        return [
            'source_book_id' => $this->firstOrCreate(SourceBook::class)->getKey(),
            'disadvantage_type_id' => $this->firstOrCreate(DisadvantageType::class)->getKey(),
            'ring_id' => $this->firstOrCreate(Ring::class)->getKey(),
            'key' => StringHelper::key($name),
            'name' => $name,
        ];
    }
}
