<?php

namespace Tests\Unit\Http\Controllers\Campaign;

use App\Models\Character\Character;
use App\Models\Core\Campaign;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

final class ViewControllerTest extends TestCase
{


    private function hit(?Campaign $campaign = null): TestResponse
    {
        if ($campaign === null) {
            $campaign = Campaign::factory()->create();
        }

        return $this->get(route('campaign.view.show', [
            'campaign' => $campaign->uuid,
        ]));
    }


    public function testShowGuest(): void
    {
        $this->hit()->assertRedirect(route('auth.login.show'));
    }


    public function testShowOwner(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $campaign = Campaign::factory()->create([
            'user_id' => $user->getKey(),
        ]);

        $campaign->users()->attach($user->getKey());

        $character = Character::factory()->create([
            'user_id' => $user->getKey(),
        ]);
        $campaign->characters()->attach($character->getKey());

        $this->actingAs($user);
        $response = $this->hit($campaign);
        $response->assertOk();

        $response->assertInertia(function (AssertableInertia $assert) {
            $assert->component('Campaign/View');
            $assert->has('campaign');
            $assert->has('characters');

            $campaign = $assert->toArray()['props']['campaign'];
            self::assertIsArray($campaign);
            self::assertArrayHasKey('characters', $campaign);

            $campaignCharacters = $campaign['characters'];
            self::assertIsArray($campaignCharacters);
            self::assertCount(1, $campaignCharacters);

            foreach ($campaignCharacters as $character) {
                self::assertIsArray($character);
                self::assertArrayHasKey('clan', $character);
                self::assertArrayHasKey('family', $character);
                self::assertArrayHasKey('school', $character);
            }

            $usersCharacters = $assert->toArray()['props']['characters'];
            self::assertIsArray($usersCharacters);
            self::assertCount(1, $usersCharacters);
        });
    }


    public function testShowCampaignUser(): void
    {
        $campaign = Campaign::factory()->create();

        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $campaign->users()->attach($user->getKey());

        $character = Character::factory()->create([
            'user_id' => $user->getKey(),
        ]);
        $campaign->characters()->attach($character->getKey());

        $this->actingAs($user);
        $response = $this->hit($campaign);
        $response->assertOk();

        $response->assertInertia(function (AssertableInertia $assert) {
            $assert->component('Campaign/View');
            $assert->has('campaign');
            $assert->has('characters');

            $campaign = $assert->toArray()['props']['campaign'];
            self::assertIsArray($campaign);
            self::assertArrayHasKey('characters', $campaign);

            $campaignCharacters = $campaign['characters'];
            self::assertIsArray($campaignCharacters);
            self::assertCount(1, $campaignCharacters);

            foreach ($campaignCharacters as $character) {
                self::assertIsArray($character);
                self::assertArrayHasKey('clan', $character);
                self::assertArrayHasKey('family', $character);
                self::assertArrayHasKey('school', $character);
            }

            $usersCharacters = $assert->toArray()['props']['characters'];
            self::assertIsArray($usersCharacters);
            self::assertCount(1, $usersCharacters);
        });
    }


    public function testShowOtherUser(): void
    {
        $campaign = Campaign::factory()->create();

        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $this->actingAs($user);
        $this->hit($campaign)->assertForbidden();
    }
}
