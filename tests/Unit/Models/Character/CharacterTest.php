<?php

namespace Tests\Unit\Models\Character;

use App\Models\Character\Advantage;
use App\Models\Character\Character;
use App\Models\Character\Clan;
use App\Models\Character\Disadvantage;
use App\Models\Character\Family;
use App\Models\Character\School;
use App\Models\Character\Technique;
use App\Models\Core\Campaign;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

final class CharacterTest extends TestCase
{


    public function testGetRouteKeyName(): void
    {
        self::assertSame('uuid', (new Character())->getRouteKeyName());
    }


    public function testUserRelationship(): void
    {
        $user = User::factory()->create();

        $character = Character::factory()->create();
        $character->user()->associate($user);

        self::assertTrue($character->user->is($user));
    }


    public function testClanRelationship(): void
    {
        $clan = Clan::factory()->create();

        $character = Character::factory()->create();
        $character->clan()->associate($clan);

        self::assertTrue($character->clan->is($clan));
    }


    public function testFamilyRelationship(): void
    {
        $family = Family::factory()->create();

        $character = Character::factory()->create();
        $character->family()->associate($family);

        self::assertTrue($character->family->is($family));
    }


    public function testSchoolRelationship(): void
    {
        $school = School::factory()->create();

        $character = Character::factory()->create();
        $character->school()->associate($school);

        self::assertTrue($character->school->is($school));
    }


    public function testAdvantagesRelationship(): void
    {
        $character = Character::factory()->create();
        self::assertEmpty($character->advantages);

        $character->advantages()->attach([
            Advantage::factory()->create()->getKey(),
            Advantage::factory()->create()->getKey(),
            Advantage::factory()->create()->getKey(),
        ]);

        $character->load('advantages');
        self::assertCount(3, $character->advantages);
    }


    public function testDisadvantagesRelationship(): void
    {
        $character = Character::factory()->create();
        self::assertEmpty($character->disadvantages);

        $character->disadvantages()->attach([
            Disadvantage::factory()->create()->getKey(),
            Disadvantage::factory()->create()->getKey(),
            Disadvantage::factory()->create()->getKey(),
        ]);

        $character->load('disadvantages');
        self::assertCount(3, $character->disadvantages);
    }


    public function testTechniquesRelationship(): void
    {
        $character = Character::factory()->create();
        self::assertEmpty($character->techniques);

        $character->techniques()->attach([
            Technique::factory()->create()->getKey(),
            Technique::factory()->create()->getKey(),
            Technique::factory()->create()->getKey(),
        ]);

        $character->load('techniques');
        self::assertCount(3, $character->techniques);
    }


    public function testCampaignsRelationship(): void
    {
        $character = Character::factory()->create();
        self::assertEmpty($character->campaigns);

        $character->campaigns()->attach([
            Campaign::factory()->create()->getKey(),
            Campaign::factory()->create()->getKey(),
            Campaign::factory()->create()->getKey(),
        ]);

        $character->load('campaigns');
        self::assertCount(3, $character->campaigns);
    }
}
