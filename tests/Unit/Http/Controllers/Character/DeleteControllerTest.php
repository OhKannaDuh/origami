<?php

namespace Tests\Unit\Http\Controllers\Character;

use App\Models\Character\Character;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

final class DeleteControllerTest extends TestCase
{


    private function hit(?Character $character = null): TestResponse
    {
        if ($character === null) {
            $character = Character::factory()->create();
        }
        return $this->post(route('character.delete.delete', [
            'character' => $character->uuid,
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

        $character = Character::factory()->create([
            'user_id' => $user->getKey(),
        ]);

        $this->actingAs($user);
        $this->hit($character)->assertRedirect(route('character.index.show'));

        self::assertFalse($character->exists());
    }


    public function testDeleteOtherUser(): void
    {
        $character = Character::factory()->create();

        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $this->actingAs($user);
        $this->hit($character)->assertForbidden();
    }
}
