<?php

namespace Tests\Unit\Http\Controllers\Character;

use App\Models\Character\Character;
use App\Models\User;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

final class CopyControllerTest extends TestCase
{


    private function hit(?Character $character = null): TestResponse
    {
        if ($character === null) {
            $character = Character::factory()->create();
        }
        return $this->post(route('character.copy.copy', [
            'character' => $character->uuid,
        ]));
    }


    public function testCopyGuest(): void
    {
        $this->hit()->assertRedirect(route('auth.login.show'));
    }


    public function testCopyAuthUser(): void
    {
        $user = User::factory()->create();
        self::assertCount(0, Character::all());
        $first = Character::factory()->create();
        self::assertCount(1, Character::all());

        $this->actingAs($user);
        $this->hit($first)->assertRedirect(route('character.index.show'));
        self::assertCount(2, Character::all());

        $second = Character::query()->where('id', 2)->firstOrFail();

        self::assertSame('Copy of ' . $first->name, $second->name);
        self::assertSame($first->clan_id, $second->clan_id);
        self::assertSame($first->family_id, $second->family_id);
        self::assertSame($first->school_id, $second->school_id);
        self::assertNotSame($first->uuid, $second->uuid);
    }
}
