<?php

namespace Tests\Unit\Http\Requests\Api\Character;

use App\Http\Requests\Api\Character\SaveAdvantagesRequest;
use App\Http\Requests\Request;
use App\Models\Character\Advantage;
use App\Models\Character\Character;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Tests\Unit\Http\Requests\RequestTest;

final class SaveAdvantagesRequestTest extends RequestTest
{
    private User $user;

    private Character $character;


    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->character = Character::factory()->create();

        $this->character->user()->associate($this->user);
    }


    public function providerRequiredRules(): array
    {
        return [
            ['character.advantages'],
            ['character.advantages.0.id'],
        ];
    }


    /**
     * @return class-string<Request>&string
     */
    protected function getRequestClass(): string
    {
        return SaveAdvantagesRequest::class;
    }


    protected function getPayload(): array
    {
        $advantage = Advantage::factory()->create();

        return [
            'character' => [
                'id' => $this->character->getKey(),
                'advantages' => [
                    $advantage->toArray(),
                ],
            ],
        ];
    }


    protected function getUser(): User
    {
        return $this->user;
    }


    public function testAdded(): void
    {
        $advantages = Advantage::factory(10)->create();

        $this->character->advantages()->attach([
            $advantages[0]->getKey(),
            $advantages[1]->getKey(),
            $advantages[2]->getKey(),
        ]);

        $payload = $this->getPayload();
        $payload['character']['advantages'] = [
            $advantages[0]->toArray(),
            $advantages[2]->toArray(),
            $advantages[4]->toArray(),
            $advantages[5]->toArray(),
        ];

        $request = $this->getRequest($payload);
        assert($request instanceof SaveAdvantagesRequest);

        self::assertSame([
            $advantages[4]->getKey(),
            $advantages[5]->getKey(),
        ], $request->added());
    }


    public function testRemoved(): void
    {
        $advantages = Advantage::factory(10)->create();

        $this->character->advantages()->attach([
            $advantages[0]->getKey(),
            $advantages[1]->getKey(),
            $advantages[2]->getKey(),
        ]);

        $payload = $this->getPayload();
        $payload['character']['advantages'] = [
            $advantages[0]->toArray(),
            $advantages[2]->toArray(),
            $advantages[4]->toArray(),
            $advantages[5]->toArray(),
        ];

        $request = $this->getRequest($payload);
        assert($request instanceof SaveAdvantagesRequest);

        self::assertSame([
            $advantages[1]->getKey(),
        ], $request->removed());
    }
}
