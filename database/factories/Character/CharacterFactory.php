<?php

namespace Database\Factories\Character;

use App\Models\Character\Clan;
use App\Models\Character\Family;
use App\Models\Character\School;
use App\Models\User;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character\Character>
 */
class CharacterFactory extends Factory
{


    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'user_id' => $this->firstOrCreate(User::class)->getKey(),
            'name' => fake()->name(),
            'inventory' => [
                'containers' => [],
            ],
            'clan_id' => $this->firstOrCreate(Clan::class)->getKey(),
            'family_id' => $this->firstOrCreate(Family::class)->getKey(),
            'school_id' => $this->firstOrCreate(School::class)->getKey(),
            'school_rank' => rand(1, 5),
            'advancements' => [
                'xp' => [
                    'total' => 0,
                    'spent' => 0,
                ],
                'advancements' => [],
            ],
            'personality' => [
                'lord' => '',
                'giri' => '',
                'ninjo' => '',
                'first_notice' => '',
                'stress' => '',
                'death' => '',
                'relationships' => [
                    'mentor' => '',
                    'other' => '',
                    'parent' => '',
                ],
            ],
            'heritage' => [],
            'stats' => [
                'rings' => [
                    'air' => rand(1, 5),
                    'earth' => rand(1, 5),
                    'fire' => rand(1, 5),
                    'void' => rand(1, 5),
                    'water' => rand(1, 5),
                ],
                'social' => [
                    'honor' => rand(35, 65),
                    'glory' => rand(35, 65),
                    'status' => rand(35, 65),
                ],
                'conflict' => [
                    'strife' => 0,
                    'fatigue' => 0,
                    'void_points' => 0,
                ],
                'skills' => [],
            ],
        ];
    }
}
