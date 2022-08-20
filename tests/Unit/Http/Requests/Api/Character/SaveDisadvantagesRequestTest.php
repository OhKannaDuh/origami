<?php

namespace Tests\Unit\Http\Requests\Api\Character;

use App\Http\Requests\Api\Character\SaveDisadvantagesRequest;
use App\Http\Requests\Request;
use App\Models\Character\Character;
use App\Models\Character\Disadvantage;
use App\Models\User;
use Tests\Unit\Http\Requests\RequestTest;

final class SaveDisadvantagesRequestTest extends RequestTest
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
            ['character.disadvantages'],
            ['character.disadvantages.0.id'],
        ];
    }


    /**
     * @return class-string<Request>&string
     */
    protected function getRequestClass(): string
    {
        return SaveDisadvantagesRequest::class;
    }


    protected function getPayload(): array
    {
        $disadvantage = Disadvantage::factory()->create();

        return [
            'character' => [
                'id' => $this->character->getKey(),
                'disadvantages' => [
                    $disadvantage->toArray(),
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
        $disadvantages = Disadvantage::factory(10)->create();

        $this->character->disadvantages()->attach([
            $disadvantages[0]->getKey(),
            $disadvantages[1]->getKey(),
            $disadvantages[2]->getKey(),
        ]);

        $payload = $this->getPayload();
        $payload['character']['disadvantages'] = [
            $disadvantages[0]->toArray(),
            $disadvantages[2]->toArray(),
            $disadvantages[4]->toArray(),
            $disadvantages[5]->toArray(),
        ];

        $request = $this->getRequest($payload);
        assert($request instanceof SaveDisadvantagesRequest);

        self::assertSame([
            $disadvantages[4]->getKey(),
            $disadvantages[5]->getKey(),
        ], $request->added());
    }


    public function testRemoved(): void
    {
        $disadvantages = Disadvantage::factory(10)->create();

        $this->character->disadvantages()->attach([
            $disadvantages[0]->getKey(),
            $disadvantages[1]->getKey(),
            $disadvantages[2]->getKey(),
        ]);

        $payload = $this->getPayload();
        $payload['character']['disadvantages'] = [
            $disadvantages[0]->toArray(),
            $disadvantages[2]->toArray(),
            $disadvantages[4]->toArray(),
            $disadvantages[5]->toArray(),
        ];

        $request = $this->getRequest($payload);
        assert($request instanceof SaveDisadvantagesRequest);

        self::assertSame([
            $disadvantages[1]->getKey(),
        ], $request->removed());
    }
}
