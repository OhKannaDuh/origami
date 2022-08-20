<?php

namespace Tests\Unit\Http\Controllers\Character;

use App\Models\Character\Advantage;
use App\Models\Character\Character;
use App\Models\Character\Clan;
use App\Models\Character\Disadvantage;
use App\Models\Character\Family;
use App\Models\Character\Item;
use App\Models\Character\School;
use App\Models\Character\Technique;
use App\Models\User;
use App\StringHelper;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Arr;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

final class CreateControllerTest extends TestCase
{


    private function show(): TestResponse
    {
        return $this->get(route('character.create.show'));
    }


    private function store(array $data): TestResponse
    {
        return $this->post(route('character.create.store'), $data);
    }


    public function testShowGuest(): void
    {
        $this->show()->assertRedirect(route('auth.login.show'));
    }


    public function testShowAuthUser(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->show()->assertOk();
    }


    private function getStorePayload(): array
    {
        $clan = Clan::factory()->create();
        $family = Family::factory()->create();
        $school = School::factory()->create();

        $distinction = Advantage::factory()->create();
        $passion = Advantage::factory()->create();
        $mentorAdvantage = Advantage::factory()->create();

        $adversity = Disadvantage::factory()->create();
        $anxiety = Disadvantage::factory()->create();

        $item = Item::factory()->create();

        return [
            'character' => [
                'name' => 'Test Character',
                'clan' => ['id' => $clan->getKey()],
                'family' => ['id' => $family->getKey()],
                'school' => [
                    'id' => $school->getKey(),
                    'starting_outfit' => [
                        'item' => [
                            'type' => 'item',
                            'item_key' => $item->key,
                            'quantity' => 10,
                        ],
                    ],
                    'outfit' => [
                        'traveling_pack' => [],
                    ],
                    'techniques' => [],
                    'starting_techniques' => [
                        'Kata-1' => [
                            'type' => 'group',
                            'techniques' => [],
                        ],
                        'Kata-2' => [
                            'type' => 'choice',
                            'techniques' => [],
                        ],
                    ],
                ],
                'lord' => 'Lord text',
                'giri' => 'girigiri',
                'ninjo' => 'ninjo masters',
                'firstNotice' => 'something',
                'stress' => 'very well',
                'death' => 'test death',
                'mentor' => [
                    'description' => 'alright',
                    'advantage' => ['id' => $mentorAdvantage->getKey()],
                ],
                'otherRelationships' => [
                    'description' => 'very good',
                    'item' => ['key' => $item->key],
                ],
                'parentRelationship' => [
                    'description' => 'unpleasant',
                ],
                'heritage' => [],
                'rings' => [
                    'air' => ['rank' => 3],
                    'earth' => ['rank' => 3],
                    'fire' => ['rank' => 3],
                    'water' => ['rank' => 3],
                    'void' => ['rank' => 3],
                ],
                'honor' => 50,
                'glory' => 50,
                'status' => 50,
                'skills' => [
                    'test_skill_1' => [
                        'rank' => 1,
                    ],
                    'test_skill_2' => [
                        'rank' => 2,
                    ],
                    'test_skill_3' => [
                        'rank' => 3,
                    ],
                ],
                'distinction' => ['id' => $distinction->getKey()],
                'passion' => ['id' => $passion->getKey()],
                'adversity' => ['id' => $adversity->getKey()],
                'anxiety' => ['id' => $anxiety->getKey()],
            ],
        ];
    }


    public function testStoreGuest(): void
    {
        $payload = $this->getStorePayload();
        $this->store($payload)->assertRedirect(route('auth.login.show'));
    }


    public function testStoreAuthUser(): void
    {
        $user = User::factory()->create();
        assert($user instanceof Authenticatable);

        $this->actingAs($user);

        $payload = $this->getStorePayload();
        $response = $this->store($payload);

        $character = Character::query()->first();
        assert($character instanceof Character);

        $response->assertRedirect(route('character.view.show', [
            'character' => $character->uuid,
        ]));

        // Ensure some default values
        self::assertSame(1, $character->school_rank);
        self::assertSame(0, $character->advancements['xp']['total']);
        self::assertSame(0, $character->advancements['xp']['spent']);
        self::assertSame([], $character->advancements['advancements']);

        self::assertCount(2, $character->inventory['containers']);
        foreach ($character->inventory['containers'] as $container) {
            self::assertTrue(StringHelper::isUuid($container['id']));
        }

        self::assertSame([
            'test_skill_1' => 1,
            'test_skill_2' => 2,
            'test_skill_3' => 3,
        ], $character->stats['skills']);

        self::assertIsArray($character->personality);
        self::assertSame('Lord text', $character->personality['lord']);
        self::assertSame('girigiri', $character->personality['giri']);
        self::assertSame('ninjo masters', $character->personality['ninjo']);
        self::assertSame('something', $character->personality['first_notice']);
        self::assertSame('very well', $character->personality['stress']);
        self::assertSame('test death', $character->personality['death']);

        self::assertIsArray($character->personality['relationships']);
        self::assertSame('alright', $character->personality['relationships']['mentor']);
        self::assertSame('very good', $character->personality['relationships']['otherRelationships']);
        self::assertSame('unpleasant', $character->personality['relationships']['parentRelationship']);
    }


    public function testStoreItemChoices(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payload = $this->getStorePayload();

        $choices = [
            Item::factory()->create(),
            Item::factory()->create(),
        ];

        $payload['character']['school']['starting_outfit']['choice'] = [
            'type' => 'choice',
            'item_keys' => Arr::map($choices, fn (Item $item): string => $item->key),
        ];

        $payload['character']['school']['outfit']['choice'] = [
            [
                'key' => $choices[1]->key,
            ],
        ];

        $response = $this->store($payload);

        $character = Character::query()->firstOrFail();
        $response->assertRedirect(route('character.view.show', [
            'character' => $character->uuid,
        ]));

        self::assertSame($choices[1]->key, $character->inventory['containers'][0]['items'][1]['item_key']);
    }


    public function testStoreWithDiasho(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payload = $this->getStorePayload();
        $payload['character']['school']['starting_outfit']['daisho'] = [
            'type' => 'daisho',
        ];

        $response = $this->store($payload);

        $character = Character::query()->firstOrFail();
        $response->assertRedirect(route('character.view.show', [
            'character' => $character->uuid,
        ]));

        self::assertSame('katana', $character->inventory['containers'][0]['items'][1]['item_key']);
        self::assertSame('wakizashi', $character->inventory['containers'][0]['items'][2]['item_key']);
    }


    public function testStoreWithoutTravelingPack(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payload = $this->getStorePayload();
        unset($payload['character']['school']['outfit']['traveling_pack']);

        $response = $this->store($payload);

        $character = Character::query()->firstOrFail();
        $response->assertRedirect(route('character.view.show', [
            'character' => $character->uuid,
        ]));
    }


    public function testStoreWithHeritageItem(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payload = $this->getStorePayload();
        $item = Item::factory()->create();
        $payload['character']['heritage'] = [
            [
                'item' => $item->toArray(),
            ],
        ];

        $response = $this->store($payload);

        $character = Character::query()->firstOrFail();
        $response->assertRedirect(route('character.view.show', [
            'character' => $character->uuid,
        ]));

        self::assertSame($item->key, $character->inventory['containers'][0]['items'][1]['item_key']);
    }


    public function testStoreWithHeritageAdvantage(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payload = $this->getStorePayload();
        $advantage = Advantage::factory()->create();
        $payload['character']['heritage'] = [
            [
                'effect' => [
                    'advantage' => $advantage->toArray(),
                ],
            ],
        ];

        $response = $this->store($payload);

        $character = Character::query()->firstOrFail();
        $response->assertRedirect(route('character.view.show', [
            'character' => $character->uuid,
        ]));

        self::assertTrue($character->advantages->contains($advantage));
    }


    public function testStoreWithMentorDisadvantage(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payload = $this->getStorePayload();
        $disadvantage = Disadvantage::factory()->create();
        $payload['character']['mentor']['disadvantage'] = $disadvantage->toArray();

        $response = $this->store($payload);

        $character = Character::query()->firstOrFail();
        $response->assertRedirect(route('character.view.show', [
            'character' => $character->uuid,
        ]));

        self::assertTrue($character->disadvantages->contains($disadvantage));
    }


    public function testStoreWithStartingTechniqueGroup(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payload = $this->getStorePayload();

        $technique1 = Technique::factory()->create();
        $technique2 = Technique::factory()->create();

        $payload['character']['school']['starting_techniques']['Kata-1']['techniques'] = [
            $technique1->key,
            $technique2->key,
        ];

        $response = $this->store($payload);

        $character = Character::query()->firstOrFail();
        $response->assertRedirect(route('character.view.show', [
            'character' => $character->uuid,
        ]));

        self::assertTrue($character->techniques->contains($technique1));
        self::assertTrue($character->techniques->contains($technique2));
    }


    public function testStoreWithTechniqueChoices(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payload = $this->getStorePayload();

        $technique1 = Technique::factory()->create();
        $technique2 = Technique::factory()->create();

        $payload['character']['school']['techniques']['Kata-2'] = [
            $technique1->toArray(),
            $technique2->toArray(),
        ];

        $response = $this->store($payload);

        $character = Character::query()->firstOrFail();
        $response->assertRedirect(route('character.view.show', [
            'character' => $character->uuid,
        ]));

        self::assertTrue($character->techniques->contains($technique1));
        self::assertTrue($character->techniques->contains($technique2));
    }


    public function testStoreWithTravelingPackChoices(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $payload = $this->getStorePayload();

        $item = Item::factory()->create();

        $payload['character']['school']['outfit']['traveling_pack'] = [
            $item->toArray(),
        ];

        $response = $this->store($payload);

        $character = Character::query()->firstOrFail();
        $response->assertRedirect(route('character.view.show', [
            'character' => $character->uuid,
        ]));

        self::assertSame($item->key, $character->inventory['containers'][1]['items'][5]['item_key']);
    }
}
