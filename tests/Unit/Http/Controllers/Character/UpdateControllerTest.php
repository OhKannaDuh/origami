<?php

namespace Tests\Unit\Http\Controllers\Character;

use App\Models\Character\Character;
use App\Models\User;
use App\StringHelper;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

final class UpdateControllerTest extends TestCase
{


    private function show(?Character $character = null): TestResponse
    {
        if ($character === null) {
            $character = Character::factory()->create();
        }

        return $this->get(route('character.update.show', [
            'character' => $character->uuid,
        ]));
    }


    private function update(?Character $character = null, array $payload = []): TestResponse
    {
        if ($character === null) {
            $character = Character::factory()->create();
        }

        return $this->post(route('character.update.update', [
            'character' => $character->uuid,
        ]), $payload);
    }


    public function testDeleteGuest(): void
    {
        $this->show()->assertRedirect(route('auth.login.show'));
    }


    public function testShowOwner(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $character = Character::factory()->create([
            'user_id' => $user->getKey(),
        ]);

        $this->actingAs($user);
        $response = $this->show($character);
        $response->assertOk();

        $response->assertInertia(function (AssertableInertia $assert) {
            $assert->component('Character/Update/Show');
            $assert->has('character');

            $character = $assert->toArray()['props']['character'];
            self::assertIsArray($character);
        });
    }


    public function testShowOtherUser(): void
    {
        $character = Character::factory()->create();

        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $this->actingAs($user);
        $this->show($character)->assertForbidden();
    }


    public function testUpdateGuest(): void
    {
        $this->update()->assertRedirect(route('auth.login.show'));
    }


    public function testUpdateOwner(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $character = Character::factory()->create([
            'user_id' => $user->getKey(),
        ]);

        $this->actingAs($user);
        $response = $this->update($character, [
            'name' => 'Test Name',
            'allowNonhumanTechniques' => true,
        ]);

        $response->assertRedirect(route('character.view.show', [
            'character' => $character->uuid,
        ]));

        $character->refresh();
        self::assertSame('Test Name', $character->name);
    }


    public function testUpdateOwnerWithAvatar(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $character = Character::factory()->create([
            'user_id' => $user->getKey(),
        ]);

        $this->actingAs($user);
        $response = $this->update($character, [
            'name' => 'Test Name',
            'allowNonhumanTechniques' => true,
            'avatar' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $response->assertRedirect(route('character.view.show', [
            'character' => $character->uuid,
        ]));

        $character->refresh();
        self::assertSame('Test Name', $character->name);


        $storage = Storage::disk('avatars');
        $image = StringHelper::afterLast($character->avatar, '/');

        self::assertTrue($storage->exists($image));
        $storage->delete($image);
        self::assertFalse($storage->exists($image));
    }


    public function testUpdateOtherUser(): void
    {
        $character = Character::factory()->create();

        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $this->actingAs($user);
        $response = $this->update($character, [
            'name' => 'Test Name',
        ]);
        $response->assertForbidden();
    }
}
