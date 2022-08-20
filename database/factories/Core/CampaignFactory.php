<?php

namespace Database\Factories\Core;

use App\Models\Core\ItemType;
use App\Models\User;
use App\StringHelper;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Core\Campaign>
 */
class CampaignFactory extends Factory
{


    public function definition()
    {
        return [
            'uuid' => fake()->uuid(),
            'name' => fake()->sentence(),
            'description' => fake()->sentence(),
            'user_id' => $this->firstOrCreate(User::class)->getKey(),
        ];
    }
}
