<?php

namespace Tests\Unit\Http\Controllers\Campaign;

use App\Models\Character\Character;
use App\Models\Core\Campaign;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

final class UpdateControllerTest extends TestCase
{


    private function update(?Campaign $campaign = null, array $data = []): TestResponse
    {
        if ($campaign === null) {
            $campaign = Campaign::factory()->create();
        }

        return $this->post(route('campaign.update.update', array_merge([
            'campaign' => $campaign->uuid,
        ], $data)));
    }


    private function add(?Campaign $campaign = null, ?Character $character = null): TestResponse
    {
        if ($campaign === null) {
            $campaign = Campaign::factory()->create();
        }

        if ($character === null) {
            $character = Character::factory()->create();
        }

        return $this->post(route('campaign.update.add', [
            'campaign' => $campaign->uuid,
            'character' => $character->uuid,
        ]));
    }


    private function remove(?Campaign $campaign = null, ?Character $character = null): TestResponse
    {
        if ($campaign === null) {
            $campaign = Campaign::factory()->create();
        }

        if ($character === null) {
            $character = Character::factory()->create();
        }

        return $this->post(route('campaign.update.remove', [
            'campaign' => $campaign->uuid,
            'character' => $character->uuid,
        ]));
    }


    public function testUpdateGuest(): void
    {
        $this->update()->assertRedirect(route('auth.login.show'));
    }


    public function testUpdateOwner(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $campaign = Campaign::factory()->create([
            'user_id' => $user->getKey(),
            'description' => 'hello',
        ]);

        $campaign->users()->attach($user->getKey());

        $this->actingAs($user);
        $response = $this->update($campaign, [
            'name' => 'Test',
            'description' => $campaign->description,
        ]);

        $response->assertSessionHas('message', 'Campaign information updated.');
        $response->assertRedirect(route('campaign.view.show', [
            'campaign' => $campaign->uuid,
        ]));

        $campaign->refresh();
        self::assertSame('Test', $campaign->name);
    }


    public function testUpdateOwnerWithDescription(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $campaign = Campaign::factory()->create([
            'user_id' => $user->getKey(),
            'description' => 'hello',
        ]);

        $campaign->users()->attach($user->getKey());

        $this->actingAs($user);
        $response = $this->update($campaign, [
            'name' => 'Test',
            'description' => 'goodbye',
        ]);

        $response->assertSessionHas('message', 'Campaign information updated.');
        $response->assertRedirect(route('campaign.view.show', [
            'campaign' => $campaign->uuid,
        ]));

        $campaign->refresh();
        self::assertSame('Test', $campaign->name);
        self::assertSame('goodbye', $campaign->description);
    }


    public function testUpdateUserInCampaign(): void
    {
        $campaign = Campaign::factory()->create();


        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $campaign->users()->attach($user->getKey());

        $this->actingAs($user);
        $this->update($campaign)->assertForbidden();
    }


    public function testUpdateOtherUser(): void
    {
        $campaign = Campaign::factory()->create();

        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $this->actingAs($user);
        $this->update($campaign)->assertForbidden();
    }


    public function testAddGuest(): void
    {
        $this->add()->assertRedirect(route('auth.login.show'));
    }


    public function testAddOwner(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $campaign = Campaign::factory()->create([
            'user_id' => $user->getKey(),
        ]);

        $campaign->users()->attach($user->getKey());
        $character = Character::factory()->create();

        $this->actingAs($user);
        $response = $this->add($campaign, $character);
        $response->assertSessionHas('message', $character->name . ' was added.');
        $response->assertRedirect(route('campaign.view.show', [
            'campaign' => $campaign->uuid,
        ]));

        $campaign->load('characters');
        self::assertTrue($campaign->characters->contains($character));
    }


    public function testAddCampaignUser(): void
    {
        $owner = User::factory()->create();
        $campaign = Campaign::factory()->create([
            'user_id' => $owner->getKey(),
        ]);

        $other = User::factory()->create();
        assert($other instanceof Authenticatable);

        $campaign->users()->attach([
            $owner->getKey(),
            $other->getKey(),
        ]);

        $character = Character::factory()->create();

        $this->actingAs($other);
        $response = $this->add($campaign, $character);
        $response->assertSessionHas('message', $character->name . ' was added.');
        $response->assertRedirect(route('campaign.view.show', [
            'campaign' => $campaign->uuid,
        ]));

        $campaign->load('characters');
        self::assertTrue($campaign->characters->contains($character));
    }


    public function testAddNonCampaignUser(): void
    {
        $owner = User::factory()->create();
        $campaign = Campaign::factory()->create([
            'user_id' => $owner->getKey(),
        ]);

        $other = User::factory()->create();
        assert($other instanceof Authenticatable);

        $campaign->users()->attach([
            $owner->getKey(),
        ]);

        $character = Character::factory()->create();

        $this->actingAs($other);
        $this->add($campaign, $character)->assertForbidden();
    }


    public function testRemoveGuest(): void
    {
        $this->remove()->assertRedirect(route('auth.login.show'));
    }


    public function testRemoveOwner(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $campaign = Campaign::factory()->create([
            'user_id' => $user->getKey(),
        ]);

        $campaign->users()->attach($user->getKey());
        $character = Character::factory()->create();
        $campaign->characters()->attach($character);

        $campaign->load('characters');
        self::assertTrue($campaign->characters->contains($character));

        $this->actingAs($user);
        $response = $this->remove($campaign, $character);
        $response->assertSessionHas('message', $character->name . ' was removed.');
        $response->assertRedirect(route('campaign.view.show', [
            'campaign' => $campaign->uuid,
        ]));

        $campaign->load('characters');
        self::assertFalse($campaign->characters->contains($character));
    }


    public function testRemoveCampaignUser(): void
    {
        $owner = User::factory()->create();
        $campaign = Campaign::factory()->create([
            'user_id' => $owner->getKey(),
        ]);


        $other = User::factory()->create();
        assert($other instanceof Authenticatable);

        $campaign->users()->attach([
            $owner->getKey(),
            $other->getKey(),
        ]);

        $character = Character::factory()->create();
        $campaign->characters()->attach($character);

        $campaign->load('characters');
        self::assertTrue($campaign->characters->contains($character));

        $this->actingAs($other);
        $response = $this->remove($campaign, $character);
        $response->assertSessionHas('message', $character->name . ' was removed.');
        $response->assertRedirect(route('campaign.view.show', [
            'campaign' => $campaign->uuid,
        ]));

        $campaign->load('characters');
        self::assertFalse($campaign->characters->contains($character));
    }


    public function testRemoveNonCampaignUser(): void
    {
        $owner = User::factory()->create();
        $campaign = Campaign::factory()->create([
            'user_id' => $owner->getKey(),
        ]);


        $other = User::factory()->create();
        assert($other instanceof Authenticatable);

        $campaign->users()->attach([
            $owner->getKey(),
        ]);

        $character = Character::factory()->create();

        $this->actingAs($other);
        $this->remove($campaign, $character)->assertForbidden();
    }
}
