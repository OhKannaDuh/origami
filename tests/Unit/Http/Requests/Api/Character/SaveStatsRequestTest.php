<?php

namespace Tests\Unit\Http\Requests\Api\Character;

use App\Http\Requests\Api\Character\SaveStatsRequest;
use App\Http\Requests\Request;
use App\Models\Character\Character;
use App\Models\Character\Disadvantage;
use App\Models\User;
use Tests\Unit\Http\Requests\RequestTest;

final class SaveStatsRequestTest extends RequestTest
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
            ['character.stats'],
            ['character.stats.rings.air'],
            ['character.stats.rings.earth'],
            ['character.stats.rings.fire'],
            ['character.stats.rings.void'],
            ['character.stats.rings.water'],
            ['character.stats.social.honor'],
            ['character.stats.social.glory'],
            ['character.stats.social.status'],
            ['character.stats.conflict.strife'],
            ['character.stats.conflict.fatigue'],
            ['character.stats.conflict.void_points'],
        ];
    }


    /**
     * @return class-string<Request>&string
     */
    protected function getRequestClass(): string
    {
        return SaveStatsRequest::class;
    }


    protected function getPayload(): array
    {
        return [
            'character' => [
                'id' => $this->character->getKey(),
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
            ],
        ];
    }


    protected function getUser(): User
    {
        return $this->user;
    }
}
