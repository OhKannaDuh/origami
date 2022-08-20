<?php

namespace Database\Factories\Character;

use App\Models\Character\Family;
use App\Models\Character\Technique;
use App\Models\Core\Ring;
use App\Models\Core\Skill;
use App\Models\Core\SourceBook;
use App\StringHelper;
use Database\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Character\School>
 */
class SchoolFactory extends Factory
{


    public function definition(): array
    {
        $name = StringHelper::random(32) . ' School';
        return [
            'source_book_id' => $this->firstOrCreate(SourceBook::class)->getKey(),
            'key' => StringHelper::key($name),
            'name' => $name,
            'ring_one_id' => $this->firstOrCreate(Ring::class)->getKey(),
            'ring_two_id' => $this->firstOrCreate(Ring::class)->getKey(),
            'starting_skill_amount' => rand(3, 5),
            'starting_skills' => [
                $this->firstOrCreate(Skill::class)->key,
                $this->firstOrCreate(Skill::class)->key,
                $this->firstOrCreate(Skill::class)->key,
                $this->firstOrCreate(Skill::class)->key,
                $this->firstOrCreate(Skill::class)->key,
                $this->firstOrCreate(Skill::class)->key,
                $this->firstOrCreate(Skill::class)->key,
            ],
            'starting_techniques' => [
                'choice-1' => [
                    'key' => 'choice',
                    'name' => 'Choice',
                    'type' => 'choice',
                    'amount' => 1,
                    'techniques' => [
                        $this->firstOrCreate(Technique::class)->key,
                        $this->firstOrCreate(Technique::class)->key,
                    ],
                ],
                'group-1' => [
                    'key' => 'group',
                    'name' => 'Group',
                    'type' => 'group',
                    'techniques' => [
                        $this->firstOrCreate(Technique::class)->key,
                        $this->firstOrCreate(Technique::class)->key,
                    ],
                ],
            ],
            'starting_outfit' => [],
            'curriculum' => [],
            'school_ability_id' => $this->firstOrCreate(Technique::class)->getKey(),
            'mastery_ability_id' => $this->firstOrCreate(Technique::class)->getKey(),
            'family_id' => $this->firstOrCreate(Family::class)->getKey(),
        ];
    }
}
