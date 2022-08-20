<?php

namespace Tests\Unit\Http\Controllers\Campaign;

use App\Models\Core\Campaign;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

final class JoinControllerTest extends TestCase
{


    private function hit(?Campaign $campaign = null): TestResponse
    {
        if ($campaign === null) {
            $campaign = Campaign::factory()->create();
        }

        return $this->get(route('campaign.join.join', [
            'campaign' => $campaign->uuid,
        ]));
    }


    public function testJoinGuest(): void
    {
        $this->hit()->assertRedirect(route('auth.login.show'));
    }


    public function testJoinNewAuthUser(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $campaign = Campaign::factory()->create();

        $this->actingAs($user);
        $response = $this->hit($campaign);
        $response->assertSessionHas('message', "You've joined '{$campaign->name}'.");
        $response->assertRedirect(route('campaign.view.show', [
            'campaign' => $campaign->uuid,
        ]));

        self::assertTrue($campaign->users->contains($user));
    }


    /**
     * Ensure we alert users that try to join a campaign they are already in.
     */
    public function testJoinExistingAuthUser(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $campaign = Campaign::factory()->create();

        $campaign->users()->attach($user);

        $this->actingAs($user);
        $response = $this->hit($campaign);
        $response->assertSessionHas('message', 'You were already in this campaign.');
        $response->assertRedirect(route('campaign.view.show', [
            'campaign' => $campaign->uuid,
        ]));
    }
}
