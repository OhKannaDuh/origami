<?php

namespace Tests\Unit\Http\Controllers\Character;

use App\Models\Character\Advantage;
use App\Models\Character\Character;
use App\Models\Character\Disadvantage;
use App\Models\Core\Campaign;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

final class ViewControllerTest extends TestCase
{


    public function show(?Character $character = null): TestResponse
    {
        if ($character === null) {
            $character = Character::factory()->create();
        }

        return $this->get(route('character.view.show', [
            'character' => $character->uuid,
        ]));
    }


    public function campaign(?Character $character = null, ?Campaign $campaign = null): TestResponse
    {
        if ($character === null) {
            $character = Character::factory()->create();
        }

        if ($campaign === null) {
            $campaign = Campaign::factory()->create();
        }

        return $this->get(route('character.view.campaign', [
            'character' => $character->uuid,
            'campaign' => $campaign->uuid,
        ]));
    }


    public function testShowGuest(): void
    {
        $this->show()->assertRedirect(route('auth.login.show'));
    }


    public function testShowOwner(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $character = Character::factory()->create([
            'user_id' => $user->getKey(),
        ]);

        $this->actingAs($user);
        $response = $this->show($character);
        $response->assertOk();

        $character->advantages()->attach(
            Advantage::factory()->create()->getKey(),
        );

        $character->disadvantages()->attach(
            Disadvantage::factory()->create()->getKey(),
        );

        $response->assertInertia(function (AssertableInertia $assert) {
            $assert->component('Character/View');
            $assert->has('characterData');

            $characterData = $assert->toArray()['props']['characterData'];
            self::assertIsArray($characterData);
            self::assertArrayHasKey('advantages', $characterData);
            self::assertArrayHasKey('campaigns', $characterData);
            self::assertArrayHasKey('clan', $characterData);
            self::assertArrayHasKey('disadvantages', $characterData);
            self::assertArrayHasKey('family', $characterData);
            self::assertArrayHasKey('school', $characterData);
            self::assertArrayHasKey('techniques', $characterData);

            self::assertIsArray($characterData['advantages']);
            foreach ($characterData['advantages'] as $advantage) {
                self::assertIsArray($advantage);
                self::assertArrayHasKey('advantage_type', $advantage);
                self::assertArrayHasKey('ring', $advantage);
            }

            self::assertIsArray($characterData['disadvantages']);
            foreach ($characterData['disadvantages'] as $disadvantage) {
                self::assertIsArray($disadvantage);
                self::assertArrayHasKey('disadvantage_type', $disadvantage);
                self::assertArrayHasKey('ring', $disadvantage);
            }

            self::assertIsArray($characterData['school']);
            self::assertArrayHasKey('available_technique_types', $characterData['school']);
            self::assertArrayHasKey('available_technique_subtypes', $characterData['school']);
        });
    }


    public function testShowOtherUser(): void
    {
        $character = Character::factory()->create();

        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $this->actingAs($user);
        $this->show($character)->assertForbidden();
    }


    public function testCampaignGuest(): void
    {
        $this->campaign()->assertRedirect(route('auth.login.show'));
    }


    public function testCampaignAsCampaignUser(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $character = Character::factory()->create([
            'user_id' => $user->getKey(),
        ]);

        $campaign = Campaign::factory()->create();
        $campaign->users()->attach($user->getKey());

        $campaign->characters()->attach($character->getKey());
        $campaign->characters()->attach(Character::factory()->create()->getKey());

        $character->advantages()->attach(
            Advantage::factory()->create()->getKey(),
        );

        $character->disadvantages()->attach(
            Disadvantage::factory()->create()->getKey(),
        );

        $this->actingAs($user);
        $response = $this->campaign($character, $campaign);
        $response->assertOk();

        $response->assertInertia(function (AssertableInertia $assert) {
            $assert->component('Character/View');
            $assert->has('characterData');

            $characterData = $assert->toArray()['props']['characterData'];
            self::assertIsArray($characterData);
            self::assertArrayHasKey('advantages', $characterData);
            self::assertArrayHasKey('campaigns', $characterData);
            self::assertArrayHasKey('clan', $characterData);
            self::assertArrayHasKey('disadvantages', $characterData);
            self::assertArrayHasKey('family', $characterData);
            self::assertArrayHasKey('school', $characterData);
            self::assertArrayHasKey('techniques', $characterData);

            self::assertIsArray($characterData['advantages']);
            foreach ($characterData['advantages'] as $advantage) {
                self::assertIsArray($advantage);
                self::assertArrayHasKey('advantage_type', $advantage);
                self::assertArrayHasKey('ring', $advantage);
            }

            self::assertIsArray($characterData['disadvantages']);
            foreach ($characterData['disadvantages'] as $disadvantage) {
                self::assertIsArray($disadvantage);
                self::assertArrayHasKey('disadvantage_type', $disadvantage);
                self::assertArrayHasKey('ring', $disadvantage);
            }

            self::assertIsArray($characterData['school']);
            self::assertArrayHasKey('available_technique_types', $characterData['school']);
            self::assertArrayHasKey('available_technique_subtypes', $characterData['school']);

            $assert->has('campaignData');

            $campaignData = $assert->toArray()['props']['campaignData'];
            self::assertIsArray($campaignData);
            self::assertArrayHasKey('characters', $campaignData);

            $campaignCharacters = $campaignData['characters'];
            self::assertIsArray($campaignCharacters);
            self::assertCount(2, $campaignCharacters);
            foreach ($campaignCharacters as $character) {
                self::assertIsArray($character);
                self::assertArrayHasKey('clan', $character);
                self::assertArrayHasKey('family', $character);
                self::assertArrayHasKey('school', $character);
            }
        });
    }


    public function testCampaignAsNotCampaignUser(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $character = Character::factory()->create([
            'user_id' => $user->getKey(),
        ]);

        $this->actingAs($user);
        $this->campaign($character)->assertForbidden();
    }


    public function testCampaignAsNotCharacterOwner(): void
    {
        $user = User::factory()->create();

        $other = User::factory()->create();
        assert($other instanceof Authenticatable);

        $character = Character::factory()->create([
            'user_id' => $user->getKey(),
        ]);

        $campaign = Campaign::factory()->create();

        $campaign->users()->attach($user->getKey());

        $this->actingAs($other);
        $this->campaign($character, $campaign)->assertForbidden();
    }
}
