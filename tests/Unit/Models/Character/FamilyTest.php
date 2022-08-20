<?php

namespace Tests\Unit\Models\Character;

use App\Models\Character\Clan;
use App\Models\Character\Family;
use App\Models\Core\Ring;
use App\Models\Core\Skill;
use Tests\TestCase;

final class FamilyTest extends TestCase
{


    public function testClanRelationship(): void
    {
        $clan = Clan::factory()->create();

        $family = Family::factory()->create();
        $family->clan()->associate($clan);

        self::assertTrue($family->clan->is($clan));
    }


    public function testRingChoiceOneRelationship(): void
    {
        $ring = Ring::factory()->create();

        $family = Family::factory()->create();
        $family->ringChoiceOne()->associate($ring);

        self::assertTrue($family->ringChoiceOne->is($ring));
    }


    public function testRingChoiceTwoRelationship(): void
    {
        $ring = Ring::factory()->create();

        $family = Family::factory()->create();
        $family->ringChoiceTwo()->associate($ring);

        self::assertTrue($family->ringChoiceTwo->is($ring));
    }


    public function testSkillOneRelationship(): void
    {
        $skill = Skill::factory()->create();

        $family = Family::factory()->create();
        $family->skillOne()->associate($skill);

        self::assertTrue($family->skillOne->is($skill));
    }


    public function testSkillTwoRelationship(): void
    {
        $skill = Skill::factory()->create();

        $family = Family::factory()->create();
        $family->skillTwo()->associate($skill);

        self::assertTrue($family->skillTwo->is($skill));
    }
}
