<?php

namespace Tests\Unit\Actions\Character\Character;

use App\Actions\ActionInterface;
use App\Actions\Character\Character\SaveAdvancements;
use App\Events\Campaign\UpdateCharacterEvent;
use App\Http\Requests\Api\Character\SaveAdvancementsRequest;
use App\Models\Character\Character;
use App\Models\Character\Technique;
use App\Models\Core\Campaign;
use App\Models\User;
use Illuminate\Support\Arr;
use Tests\Unit\Actions\ActionTestCase;

final class SaveAdvancementsTest extends ActionTestCase
{


    protected function getAction(): ActionInterface
    {
        return new SaveAdvancements();
    }


    public function providerContextException(): array
    {
        return [
            ['request', SaveAdvancementsRequest::class, []],
        ];
    }


    private function getPayload(Character $character): array
    {
        $technique = Technique::factory()->create();

        return [
            'character' => [
                'id' => $character->getKey(),
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


    public function testExecute1(): void
    {
        $character = Character::factory()->create();
        $payload = $this->getPayload($character);

        $request = new SaveAdvancementsRequest($payload);

        $user = User::factory()->create();
        $request->setUserResolver(fn (): User => $user);

        $action = $this->getAction();
        $action->execute(['request' => $request]);

        $character->refresh();
        self::assertSame(5, $character->school_rank);
    }


    public function testExecute2(): void
    {
        $character = Character::factory()->create();
        $payload = $this->getPayload($character);

        Arr::set($payload, 'character.school_rank', 2);

        $request = new SaveAdvancementsRequest($payload);

        $user = User::factory()->create();
        $request->setUserResolver(fn (): User => $user);

        $action = $this->getAction();
        $action->execute(['request' => $request]);

        $character = $character->refresh();
        self::assertSame(2, $character->school_rank);
    }


    public function testExecute3(): void
    {
        $this->expectsEvents(UpdateCharacterEvent::class);

        $character = Character::factory()->create();

        Campaign::factory()->create()->characters()->attach($character->getKey());
        Campaign::factory()->create()->characters()->attach($character->getKey());

        $payload = $this->getPayload($character);

        $request = new SaveAdvancementsRequest($payload);

        $user = User::factory()->create();
        $request->setUserResolver(fn (): User => $user);

        $action = $this->getAction();
        $count = $action->execute(['request' => $request]);

        self::assertSame(2, $count);
    }


    public function testExecute4(): void
    {
        $this->expectsEvents(UpdateCharacterEvent::class);

        $character = Character::factory()->create();

        Campaign::factory()->create()->characters()->attach($character->getKey());
        Campaign::factory()->create()->characters()->attach($character->getKey());
        Campaign::factory()->create()->characters()->attach($character->getKey());
        Campaign::factory()->create()->characters()->attach($character->getKey());
        Campaign::factory()->create()->characters()->attach($character->getKey());

        $payload = $this->getPayload($character);

        $request = new SaveAdvancementsRequest($payload);

        $user = User::factory()->create();
        $request->setUserResolver(fn (): User => $user);

        $action = $this->getAction();
        $count = $action->execute(['request' => $request]);

        self::assertSame(5, $count);
    }
}
