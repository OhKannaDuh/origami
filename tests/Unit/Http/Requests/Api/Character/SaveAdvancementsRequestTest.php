<?php

namespace Tests\Unit\Http\Requests\Api\Character;

use App\Http\Requests\Api\Character\SaveAdvancementsRequest;
use App\Http\Requests\Request;
use App\Models\Character\Character;
use App\Models\Character\Technique;
use App\Models\User;
use Tests\Unit\Http\Requests\RequestTest;

final class SaveAdvancementsRequestTest extends RequestTest
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
            ['character.advancements'],
            ['character.school_rank'],
            ['character.stats'],
            ['character.techniques'],
            ['character.techniques.0.id'],
        ];
    }


    /**
     * @return class-string<Request>&string
     */
    protected function getRequestClass(): string
    {
        return SaveAdvancementsRequest::class;
    }


    protected function getPayload(): array
    {
        $technique = Technique::factory()->create();

        return [
            'character' => [
                'id' => $this->character->getKey(),
                'advancements' => [
                    [
                        'type' => 'ring',
                        'key' => 'air',
                        'cost' => 12,
                    ],
                ],
                'school_rank' => 5,
                'stats' => [
                    'rings' => [
                        'air' => 5,
                        'earth' => 5,
                        'fire' => 5,
                        'void' => 5,
                        'water' => 5,
                    ],
                    'social' => [
                        'honor' => 65,
                        'glory' => 65,
                        'status' => 65,
                    ],
                    'conflict' => [
                        'strife' => 0,
                        'fatigue' => 0,
                        'void_points' => 0,
                    ],
                ],
                'techniques' => [
                    $technique->toArray(),
                ]
            ],
        ];
    }


    protected function getUser(): User
    {
        return $this->user;
    }


    public function testAdvancements1(): void
    {
        $payload = $this->getPayload();

        $request = $this->getRequest($payload);
        assert($request instanceof SaveAdvancementsRequest);
        $this->validate($request);

        self::assertCount(1, $request->advancements());
    }


    public function testAdvancements2(): void
    {
        $payload = $this->getPayload();
        $payload['character']['advancements'][] = [
            'type' => 'ring',
            'key' => 'fire',
            'cost' => 9,
        ];

        $request = $this->getRequest($payload);
        assert($request instanceof SaveAdvancementsRequest);
        $this->validate($request);

        self::assertCount(2, $request->advancements());
    }
}
