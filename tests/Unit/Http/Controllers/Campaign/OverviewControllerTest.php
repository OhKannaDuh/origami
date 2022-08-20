<?php

namespace Tests\Unit\Http\Controllers\Campaign;

use App\Models\Core\Campaign;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

final class OverviewControllerTest extends TestCase
{


    private function hit(?Campaign $campaign = null): TestResponse
    {
        if ($campaign === null) {
            $campaign = Campaign::factory()->create();
        }

        return $this->get(route('campaign.overview.show', [
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

        $this->actingAs($user);
        $response = $this->hit($campaign);
        $response->assertOk();
        $response->assertInertia(function (AssertableInertia $assert) {
            $assert->component('Campaign/Overview');
            $assert->has('campaign');
        });
    }


    /**
     * Ensure we alert users that try to join a campaign they are already in.
     */
    public function testShowOtherUser(): void
    {
        $campaign = Campaign::factory()->create();


        $user = User::factory()->create();

        $this->actingAs($user);
        $this->hit($campaign)->assertForbidden();
    }
}
