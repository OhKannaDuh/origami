<?php

namespace Tests\Unit\Http\Controllers\Campaign;

use App\Models\Core\Campaign;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

final class CreateControllerTest extends TestCase
{


    public function testShowGuest(): void
    {
        $this->get(route('campaign.create.show'))
            ->assertRedirect(route('auth.login.show'));
    }


    public function testShowAuthUser(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $this->actingAs($user)
            ->get(route('campaign.create.show'))
            ->assertOk()
            ->assertInertia(fn (AssertableInertia $assert) => $assert->component('Campaign/Create'));
    }


    public function testCreateGuest(): void
    {
        $this->get(route('campaign.create.create'))
            ->assertRedirect(route('auth.login.show'));
    }


    public function testCreateAuthUser(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $response = $this->actingAs($user)
            ->post(route('campaign.create.create'), [
                'name' => 'Test',
            ]);

        $campaign = Campaign::query()->firstOrFail();
        $response->assertRedirect(route('campaign.view.show', [
            'campaign' => $campaign->uuid,
        ]));

        self::assertSame($user->getKey(), $campaign->user_id);
        self::assertTrue($campaign->users->contains($user));
    }


    public function testCreateWithoutName(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $response = $this->actingAs($user)->post(route('campaign.create.create'));
        $response->assertRedirect(route('index.show'));

        $response->assertSessionHasErrors();
        $errors = session('errors');
        self::assertSame('The name field is required.', $errors->get('name')[0]);
    }
}
