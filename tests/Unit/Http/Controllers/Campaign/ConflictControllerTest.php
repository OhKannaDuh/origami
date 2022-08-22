<?php

namespace Tests\Unit\Http\Controllers\Campaign;

use App\Models\Core\Campaign;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

final class ConflictControllerTest extends TestCase
{


    public function testShowGuest(): void
    {
        $campaign = Campaign::factory()->create();

        $this->get(route('campaign.conflict.show', [
            'campaign' => $campaign->uuid,
        ]))->assertRedirect(route('auth.login.show'));
    }


    public function testShowOwner(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $campaign = Campaign::factory()->create([
            'user_id' => $user->getKey(),
        ]);

        $campaign->users()->attach($user->getKey());

        $this->actingAs($user)
            ->get(route('campaign.conflict.show', [
                'campaign' => $campaign->uuid,
            ]))->assertOk()
                ->assertInertia(function (AssertableInertia $assert) {
                    $assert->component('Campaign/Conflict');
                    $assert->has('campaignData');

                    $campaignData = $assert->toArray()['props']['campaignData'];
                    self::assertIsArray($campaignData);
                    self::assertArrayHasKey('characters', $campaignData);
                });
    }


    public function testShowCampaignUser(): void
    {
        $campaign = Campaign::factory()->create();

        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $campaign->users()->attach($user->getKey());

        $this->actingAs($user)
            ->get(route('campaign.conflict.show', [
                'campaign' => $campaign->uuid,
            ]))->assertForbidden();
    }


    public function testShowOtherUser(): void
    {
        $campaign = Campaign::factory()->create();

        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $this->actingAs($user)
            ->get(route('campaign.conflict.show', [
                'campaign' => $campaign->uuid,
            ]))->assertForbidden();
    }
}
