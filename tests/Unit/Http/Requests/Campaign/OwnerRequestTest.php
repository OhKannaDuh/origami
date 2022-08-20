<?php

namespace Tests\Unit\Http\Requests\Campaign;

use App\Http\Requests\Campaign\OwnerRequest;
use App\Models\Core\Campaign;
use App\Models\User;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Tests\TestCase;

final class OwnerRequestTest extends TestCase
{


    /**
     * Ensure a user who owns a campaign and provides a valid campaign is authorized.
     */
    public function testAuthorize1(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $campaign = Campaign::factory()->create([
            'user_id' => $user,
        ]);

        $campaign->users()->attach($user->getKey());

        $response = $this->actingAs($user)->post(route('campaign.delete.delete', [
            'campaign' => $campaign->uuid,
        ]));

        $response->assertRedirect(route('campaign.index.show'));
    }


    /**
     * Ensure an invalid campaign uuid fails.
     */
    public function testAuthorize2(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $campaign = Campaign::factory()->create([
            'user_id' => $user,
        ]);

        $response = $this->actingAs($user)->post(route('campaign.delete.delete', [
            'campaign' => 'invalid',
        ]));

        $response->assertNotFound();
    }


    /**
     * A User has to be present or redirect to login.
     */
    public function testAuthorize3(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $campaign = Campaign::factory()->create([
            'user_id' => $user,
        ]);

        $response = $this->post(route('campaign.delete.delete', [
            'campaign' => $campaign->uuid,
        ]));

        $response->assertRedirect(route('auth.login.show'));
    }


    /**
     * Ensure the user must own the campaign.
     */
    public function testAuthorize4(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        /** @var User $owner */
        $owner = User::factory()->create();

        $campaign = Campaign::factory()->create([
            'user_id' => $owner,
        ]);

        $response = $this->actingAs($user)->post(route('campaign.delete.delete', [
            'campaign' => $campaign->uuid,
        ]));

        $response->assertForbidden();
    }


    /**
     * Ensure a campaign is a valid instnace.
     */
    public function testAuthorize5(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        Campaign::factory()->create([
            'user_id' => $user,
        ]);

        $route = FacadesRoute::getRoutes()->getByName('campaign.delete.delete');

        $request = OwnerRequest::create($route->uri());

        $route->bind($request);
        $route->setParameter('campaign', null);

        $request->setUserResolver(fn (): User => $user);
        $request->setRouteResolver(fn (): Route => $route);

        self::assertFalse($request->authorize());
    }
}
