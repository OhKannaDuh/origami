<?php

namespace Database\Seeders\SourceBooks;

use App\Models\Character\Family;
use App\Models\Character\School;
use App\Models\Character\Technique;
use App\Models\Core\Ring;
use App\Models\Core\SchoolType;
use App\Models\Core\SourceBook;
use App\Models\Core\TechniqueSubtype;
use App\Models\Core\TechniqueType;
use App\StringHelper;
use Database\Seeders\Helpers\Curriculum;
use Database\Seeders\Helpers\StartingOutfit;
use Database\Seeders\Helpers\StartingSkills;
use Database\Seeders\Helpers\StartingTechniques;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Seeder;

abstract class SchoolSeeder extends Seeder
{
    public function __construct(
        protected SourceBook|null $sourceBook = null
    ) {
    }


    protected function getSourceBookId(): int
    {
        return $this->sourceBook->getKey();
    }


    protected function create(
        string $name,
        Family  $family = null,
        array $schoolTypes,
        Ring $ringOne,
        Ring $ringTwo,
        int $startingSkillAmount,
        StartingSkills $startingSkills,
        int $honor,
        array $availableTechniqueTypes,
        StartingTechniques $startingTechniques,
        string $schoolAbilityName,
        StartingOutfit $startingOutfit,
        Curriculum $curriculum,
        string $masterAbilityName,
    ): School {
        $schoolAbility = $this->createSchoolAbility($schoolAbilityName);
        $masteryAbility = $this->createMasteryAbility($masterAbilityName);

        $school = School::query()->create(
            [
            'source_book_id' => $this->getSourceBookId(),
            'key' => StringHelper::key($name),
            'name' => $name,
            'ring_one_id' => $ringOne->getKey(),
            'ring_two_id' => $ringTwo->getKey(),
            'starting_skill_amount' => $startingSkillAmount,
            'starting_skills' => $startingSkills->toArray(),
            'starting_techniques' => $startingTechniques->toArray(),
            'starting_outfit' => $startingOutfit->toArray(),
            'curriculum' => $curriculum->toArray(),
            'school_ability_id' => $schoolAbility->getKey(),
            'mastery_ability_id' => $masteryAbility->getKey(),
            'family_id' => $family?->getKey(),
            'honor' => $honor,
            ]
        );

        $this->addTechniqueTypes($school, $availableTechniqueTypes);
        $this->addTechniqueSubtypes($school, $availableTechniqueTypes);
        $this->addSchoolTypes($school, $schoolTypes);

        return $school;
    }


    private function addTechniqueTypes(School $school, array $keys): School
    {
        foreach ($keys as $key) {
            if (StringHelper::contains($key, '_')) {
                continue;
            }

            try {
                TechniqueType::query()->where('key', $key)->firstOrFail(['id']);
            } catch (ModelNotFoundException $e) {
                throw new Exception('Technique Type with key "' . $key . "' not found.");
            }
        }

        foreach ($keys as $key) {
            if (StringHelper::contains($key, '_')) {
                continue;
            }
            $school->availableTechniqueTypes()->attach(
                TechniqueType::query()->where('key', $key)->firstOrFail(['id']),
            );
        }

        return $school;
    }


    private function addTechniqueSubtypes(School $school, array $keys): School
    {
        foreach ($keys as $key) {
            if (!StringHelper::contains($key, '_')) {
                continue;
            }

            try {
                TechniqueSubtype::query()->where('key', $key)->firstOrFail(['id']);
            } catch (ModelNotFoundException $e) {
                throw new Exception('Technique Subtype with key "' . $key . "' not found.");
            }
        }

        foreach ($keys as $key) {
            if (!StringHelper::contains($key, '_')) {
                continue;
            }
            $school->availableTechniqueSubtypes()->attach(
                TechniqueSubtype::query()->where('key', $key)->firstOrFail(['id']),
            );
        }

        return $school;
    }


    private function addSchoolTypes(School $school, array $keys): School
    {
        foreach ($keys as $key) {
            try {
                SchoolType::query()->where('key', $key)->firstOrFail(['id']);
            } catch (ModelNotFoundException $e) {
                throw new Exception('School Type with key "' . $key . "' not found.");
            }
        }

        foreach ($keys as $key) {
            $school->schoolTypes()->attach(
                SchoolType::query()->where('key', $key)->firstOrFail(['id']),
            );
        }

        return $school;
    }


    protected function createAbility(string $name, int $rank, TechniqueSubtype $type): Technique
    {
        return Technique::query()->create(
            [
            'source_book_id' => $this->getSourceBookId(),
            'technique_subtype_id' => $type->getKey(),
            'key' => StringHelper::key($name),
            'name' => $name,
            'rank' => $rank,
            'description' => '_',
            ]
        );
    }


    protected function createSchoolAbility(string $name): Technique
    {
        return $this->createAbility(
            $name,
            1,
            TechniqueSubtype::query()->where('key', 'school_ability')->first(['id']),
        );
    }


    protected function createMasteryAbility(string $name): Technique
    {
        return $this->createAbility(
            $name,
            6,
            TechniqueSubtype::query()->where('key', 'mastery_ability')->first(['id']),
        );
    }
}
