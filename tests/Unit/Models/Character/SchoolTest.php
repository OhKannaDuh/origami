<?php

namespace Tests\Unit\Models\Character;

use App\Models\Character\Clan;
use App\Models\Character\Family;
use App\Models\Character\School;
use App\Models\Core\Ring;
use App\Models\Core\SchoolType;
use App\Models\Core\Skill;
use App\Models\Core\TechniqueSubtype;
use App\Models\Core\TechniqueType;
use Tests\TestCase;

final class SchoolTest extends TestCase
{


    public function testRingOneRelationship(): void
    {
        $ring = Ring::factory()->create();

        $school = School::factory()->create();
        $school->ringOne()->associate($ring);

        self::assertTrue($school->ringOne->is($ring));
    }


    public function testRingTwoRelationship(): void
    {
        $ring = Ring::factory()->create();

        $school = School::factory()->create();
        $school->ringTwo()->associate($ring);

        self::assertTrue($school->ringTwo->is($ring));
    }


    public function testFamilyRelationship(): void
    {
        $family = Family::factory()->create();

        $school = School::factory()->create();
        $school->family()->associate($family);

        self::assertTrue($school->family->is($family));
    }


    public function testAvailableTechniqueTypesRelationship(): void
    {
        $school = School::factory()->create();
        self::assertEmpty($school->availableTechniqueTypes);

        $school->availableTechniqueTypes()->attach([
            TechniqueType::factory()->create()->getKey(),
            TechniqueType::factory()->create()->getKey(),
            TechniqueType::factory()->create()->getKey(),
            TechniqueType::factory()->create()->getKey(),
        ]);

        $school->load('availableTechniqueTypes');
        self::assertCount(4, $school->availableTechniqueTypes);
    }


    public function testAvailableTechniqueSubtypesRelationship(): void
    {
        $school = School::factory()->create();
        self::assertEmpty($school->availableTechniqueSubtypes);

        $school->availableTechniqueSubtypes()->attach([
            TechniqueSubtype::factory()->create()->getKey(),
            TechniqueSubtype::factory()->create()->getKey(),
            TechniqueSubtype::factory()->create()->getKey(),
            TechniqueSubtype::factory()->create()->getKey(),
        ]);

        $school->load('availableTechniqueSubtypes');
        self::assertCount(4, $school->availableTechniqueSubtypes);
    }


    public function testSchoolTypesRelationship(): void
    {
        $school = School::factory()->create();
        self::assertEmpty($school->schoolTypes);

        $school->schoolTypes()->attach([
            SchoolType::factory()->create()->getKey(),
            SchoolType::factory()->create()->getKey(),
        ]);

        $school->load('schoolTypes');
        self::assertCount(2, $school->schoolTypes);
    }
}
