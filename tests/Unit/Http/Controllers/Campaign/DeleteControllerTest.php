<?php

namespace Tests\Unit\Http\Controllers\Campaign;

use App\Models\Core\Campaign;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

final class DeleteControllerTest extends TestCase
{


    private function hit(?Campaign $campaign = null): TestResponse
    {
        if ($campaign === null) {
            $campaign = Campaign::factory()->create();
        }

        return $this->post(route('campaign.delete.delete', [
            'campaign' => $campaign->uuid,
        ]));
    }


    public function testDeleteGuest(): void
    {
        $this->hit()->assertRedirect(route('auth.login.show'));
    }


    public function testDeleteOwner(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $campaign = Campaign::factory()->create([
            'user_id' => $user,
        ]);

        $campaign->users()->attach($user->getKey());

        $this->actingAs($user);
        $this->hit($campaign)->assertRedirect(route('campaign.index.show'));

        self::assertFalse($campaign->exists());
    }
}
