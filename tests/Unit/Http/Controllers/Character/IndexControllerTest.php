<?php

namespace Tests\Unit\Http\Controllers\Character;

use App\Models\Character\Character;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

final class IndexControllerTest extends TestCase
{


    private function hit(): TestResponse
    {
        return $this->get(route('character.index.show'));
    }


    public function testShowGuest(): void
    {
        $this->hit()->assertRedirect(route('auth.login.show'));
    }


    public function testShowAuthUser(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        Character::factory(3)->create([
            'user_id' => $user->getKey(),
        ]);

        $this->actingAs($user);
        $response = $this->hit();
        $response->assertOk();

        $response->assertInertia(function (AssertableInertia $assert) {
            $assert->component('Character/Index');
            $assert->has('characters');

            $characters = $assert->toArray()['props']['characters'];
            self::assertIsArray($characters);
            self::assertCount(3, $characters);

            foreach ($characters as $character) {
                self::assertIsArray($character);
                self::assertArrayHasKey('clan', $character);
                self::assertArrayHasKey('family', $character);
                self::assertArrayHasKey('school', $character);
            }
        });
    }
}
