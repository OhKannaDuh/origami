<?php

namespace Database\Factories\Character;

use App\Models\Core\SourceBook;
use App\Models\Core\TechniqueSubtype;
use App\StringHelper;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character\Technique>
 */
class TechniqueFactory extends Factory
{


    public function definition(): array
    {
        $name = StringHelper::random(32);
        return [
            'source_book_id' => $this->firstOrCreate(SourceBook::class)->getKey(),
            'technique_subtype_id' => $this->firstOrCreate(TechniqueSubtype::class)->getKey(),
            'key' => StringHelper::key($name),
            'name' => $name,
            'rank' => rand(1, 5),
            'description' => fake()->sentence(),
        ];
    }
}
