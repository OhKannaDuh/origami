<?php

namespace Tests\Unit\Models\Core;

use App\Models\Character\Character;
use App\Models\Core\Campaign;
use App\Models\User;
use Tests\TestCase;

final class CampaignTest extends TestCase
{


    public function testGetRouteKeyName(): void
    {
        self::assertSame('uuid', (new Campaign())->getRouteKeyName());
    }


    public function testCharactersRelationship(): void
    {
        $campaign = Campaign::factory()->create();
        self::assertEmpty($campaign->characters);

        $campaign->characters()->attach([
            Character::factory()->create()->getKey(),
            Character::factory()->create()->getKey(),
            Character::factory()->create()->getKey(),
            Character::factory()->create()->getKey(),
            Character::factory()->create()->getKey(),
        ]);

        $campaign->load('characters');
        self::assertCount(5, $campaign->characters);
    }


    public function testUsersRelationship(): void
    {
        $campaign = Campaign::factory()->create();
        self::assertEmpty($campaign->users);

        $campaign->users()->attach([
            User::factory()->create()->getKey(),
            User::factory()->create()->getKey(),
        ]);

        $campaign->load('users');
        self::assertCount(2, $campaign->users);
    }
}
