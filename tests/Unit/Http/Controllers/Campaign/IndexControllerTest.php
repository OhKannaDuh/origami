<?php

namespace Tests\Unit\Http\Controllers\Campaign;

use App\Models\Character\Character;
use App\Models\Core\Campaign;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

final class IndexControllerTest extends TestCase
{


    private function hit(): TestResponse
    {
        return $this->get(route('campaign.index.show'));
    }


    public function testShowGuest(): void
    {
        $this->hit()->assertRedirect(route('auth.login.show'));
    }


    public function testShowAuthUser(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $campaigns = Campaign::factory(4)->create();
        foreach ($campaigns as $campaign) {
            $campaign->users()->attach($user->getKey());
            $characters = Character::factory(2)->create();
            foreach ($characters as $character) {
                $campaign->characters()->attach($character->getKey());
            }
        }

        $this->actingAs($user);
        $response = $this->hit();
        $response->assertOk();
        $response->assertInertia(function (AssertableInertia $assert) {
            $assert->component('Campaign/Index');
            $assert->has('campaigns');

            $campaigns = $assert->toArray()['props']['campaigns'];
            self::assertIsArray($campaigns);
            self::assertCount(4, $campaigns);
            foreach ($campaigns as $campaign) {
                self::assertIsArray($campaign);
                self::assertArrayHasKey('characters_count', $campaign);
                self::assertSame(2, $campaign['characters_count']);
            }
        });
    }
}
