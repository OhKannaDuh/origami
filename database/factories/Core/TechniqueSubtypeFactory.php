<?php

namespace Database\Factories\Core;

use App\Models\Core\TechniqueType;
use App\StringHelper;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Core\TechniqueSubtype>
 */
class TechniqueSubtypeFactory extends Factory
{


    public function definition()
    {
        $name = StringHelper::random(32);
        return [
            'technique_type_id' => $this->firstOrCreate(TechniqueType::class)->getKey(),
            'key' => StringHelper::key($name),
            'name' => $name,
        ];
    }
}
