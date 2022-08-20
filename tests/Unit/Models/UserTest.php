<?php

namespace Tests\Unit\Models;

use App\Models\Character\Character;
use App\Models\Core\Campaign;
use App\Models\User;
use Tests\TestCase;

final class UserTest extends TestCase
{


    public function testCharactersRelationship(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        self::assertEmpty($user->characters);


        for ($i = 0; $i < 3; $i++) {
            Character::factory()->create([
                'user_id' => $user->getKey(),
            ]);
        }

        $user->load('characters');
        self::assertCount(3, $user->characters);
    }


    public function testOwnedCampaignsRelationship(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        self::assertEmpty($user->ownedCampaigns);


        for ($i = 0; $i < 3; $i++) {
            Campaign::factory()->create([
                'user_id' => $user->getKey(),
            ]);
        }

        $user->load('ownedCampaigns');
        self::assertCount(3, $user->ownedCampaigns);
    }


    public function testCampaignsRelationship(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        self::assertEmpty($user->campaigns);


        for ($i = 0; $i < 3; $i++) {
            Campaign::factory()->create()->users()->attach($user);
        }

        $user->load('campaigns');
        self::assertCount(3, $user->campaigns);
    }


    public function testGetAvatarUrl1(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'email' => 'test@example.com',
        ]);

        self::assertSame('https://www.gravatar.com/avatar/55502f40dc8b7c769880b10874abc9d0', $user->getAvatarUrl());
    }


    public function testGetAvatarUrl2(): void
    {
        /** @var User $user */
        $user = User::factory()->create([
            'email' => 'Test2@example.com',
        ]);

        self::assertSame('https://www.gravatar.com/avatar/43b05f394d5611c54a1a9e8e20baee21', $user->getAvatarUrl());
    }
}
