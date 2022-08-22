<?php

namespace Tests\Unit\Http\Controllers\Api;

use App\Events\Campaign\UpdateCharacterEvent;
use App\Models\Character\Advantage;
use App\Models\Character\Character;
use App\Models\Character\Disadvantage;
use App\Models\Character\Item;
use App\Models\Character\Technique;
use App\Models\Core\Campaign;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

use function Pest\Laravel\put;

final class SaveControllerTest extends TestCase
{
    private User $user;

    private Character $character;


    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->character = Character::factory()->create([
            'user_id' => $this->user,
        ]);
    }


    public function testSaveInventory(): void
    {
        $item = Item::factory()->create();

        $this->actingAs($this->user)
            ->put(route('api.character.save.inventory'), [
                'character' => [
                    'id' => $this->character->getKey(),
                ],
                'inventory' => [
                    'containers' => [
                        [
                            'id' => Uuid::uuid6()->toString(),
                            'name' => 'Container',
                            'items' => [
                                [
                                    'quantity' => 5,
                                    'item_key' => $item->key,
                                ],
                            ],
                        ],
                    ],
                ],
            ])
            ->assertOk();

        $this->character->refresh();

        self::assertSame([
            'item_key' => $item->key,
            'quantity' => 5,
        ], $this->character->inventory['containers'][0]['items'][0]);
    }


    public function testSaveAdvantages(): void
    {
        $advantages = Advantage::factory(10)->create();
        $this->character->advantages()->attach([
            $advantages[0]->getKey(),
            $advantages[1]->getKey(),
            $advantages[2]->getKey(),
        ]);
        self::assertRelationshipCount(3, $this->character, 'advantages');

        $this->actingAs($this->user)
            ->put(route('api.character.save.advantages'), [
                'character' => [
                    'id' => $this->character->getKey(),
                    'advantages' => [
                        $advantages[0]->toArray(),
                        $advantages[2]->toArray(),
                        $advantages[4]->toArray(),
                        $advantages[5]->toArray(),
                    ],
                ],
            ])
            ->assertOk();

        self::assertRelationshipCount(4, $this->character, 'advantages');
    }


    public function testSaveDisadvantages(): void
    {
        Disadvantage::factory(10)->create();
        $this->character->disadvantages()->attach(Disadvantage::all()->random(3));
        self::assertRelationshipCount(3, $this->character, 'disadvantages');

        $this->actingAs($this->user)
            ->put(route('api.character.save.disadvantages'), [
                'character' => [
                    'id' => $this->character->getKey(),
                    'disadvantages' => Disadvantage::all()->random(6)->toArray(),
                ],
            ])
            ->assertOk();

        self::assertRelationshipCount(6, $this->character, 'disadvantages');
    }


    public function testSaveAdvancements(): void
    {
        $this->expectsEvents(UpdateCharacterEvent::class);

        $campaign = Campaign::factory()->create();
        $campaign->characters()->attach($this->character->getKey());

        $techniques = Technique::factory(10)->create();
        $this->character->techniques()->attach([
            $techniques[1]->getKey(),
            $techniques[2]->getKey(),
            $techniques[3]->getKey(),
            $techniques[4]->getKey(),
        ]);
        self::assertRelationshipCount(4, $this->character, 'techniques');

        $this->actingAs($this->user)
            ->put(route('api.character.save.advancements'), [
                'character' => [
                    'id' => $this->character->getKey(),
                    'advancements' => [
                        [
                            'type' => 'ring',
                            'key' => 'air',
                            'cost' => 12,
                        ],
                    ],
                    'school_rank' => 2,
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
                        ['id' => $techniques[0]->getKey()],
                        ['id' => $techniques[1]->getKey()],
                        ['id' => $techniques[2]->getKey()],
                        ['id' => $techniques[5]->getKey()],
                        ['id' => $techniques[6]->getKey()],
                        ['id' => $techniques[7]->getKey()],
                        ['id' => $techniques[8]->getKey()],
                        ['id' => $techniques[9]->getKey()],
                    ]
                ],
            ])
            ->assertOk();

            $this->character->refresh();
            self::assertSame([
                [
                    'type' => 'ring',
                    'key' => 'air',
                    'cost' => 12,
                ],
            ], $this->character->advancements);

            self::assertSame(2, $this->character->school_rank);

            self::assertSame(5, $this->character->stats['rings']['air']);
            self::assertSame(5, $this->character->stats['rings']['earth']);
            self::assertSame(5, $this->character->stats['rings']['fire']);
            self::assertSame(5, $this->character->stats['rings']['void']);
            self::assertSame(5, $this->character->stats['rings']['water']);

            self::assertSame(65, $this->character->stats['social']['honor']);
            self::assertSame(65, $this->character->stats['social']['glory']);
            self::assertSame(65, $this->character->stats['social']['status']);

            self::assertRelationshipCount(8, $this->character, 'techniques');
    }


    public function testSaveAdvancementsWithSomebodyElsesCharacter(): void
    {
        $techniques = Technique::factory(10)->create();
        $this->character->techniques()->attach([
            $techniques[1]->getKey(),
            $techniques[2]->getKey(),
            $techniques[3]->getKey(),
            $techniques[4]->getKey(),
        ]);

        $other = User::factory()->create();
        assert($other instanceof Authenticatable);

        $this->actingAs($other)
            ->put(route('api.character.save.advancements'), [
                'character' => [
                    'id' => $this->character->getKey(),
                    'advancements' => [
                        [
                            'type' => 'ring',
                            'key' => 'air',
                            'cost' => 12,
                        ],
                    ],
                    'school_rank' => 2,
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
                        ['id' => $techniques[0]->getKey()],
                        ['id' => $techniques[1]->getKey()],
                        ['id' => $techniques[2]->getKey()],
                        ['id' => $techniques[5]->getKey()],
                        ['id' => $techniques[6]->getKey()],
                        ['id' => $techniques[7]->getKey()],
                        ['id' => $techniques[8]->getKey()],
                        ['id' => $techniques[9]->getKey()],
                    ]
                ],
            ])
            ->assertForbidden();
    }


    public function testSaveAdvancementsRequiredFields(): void
    {
        $campaign = Campaign::factory()->create();
        $campaign->characters()->attach($this->character->getKey());

        $techniques = Technique::factory(10)->create();
        $this->character->techniques()->attach([
            $techniques[1]->getKey(),
            $techniques[2]->getKey(),
            $techniques[3]->getKey(),
            $techniques[4]->getKey(),
        ]);

        $payload = [
            'character' => [
                'id' => $this->character->getKey(),
                'advancements' => [
                    [
                        'type' => 'ring',
                        'key' => 'air',
                        'cost' => 12,
                    ],
                ],
                'school_rank' => 2,
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
                    ['id' => $techniques[0]->getKey()],
                    ['id' => $techniques[1]->getKey()],
                    ['id' => $techniques[2]->getKey()],
                    ['id' => $techniques[5]->getKey()],
                    ['id' => $techniques[6]->getKey()],
                    ['id' => $techniques[7]->getKey()],
                    ['id' => $techniques[8]->getKey()],
                    ['id' => $techniques[9]->getKey()],
                ]
            ],
        ];

        $withoutCharacterId = $payload;
        unset($withoutCharacterId['character']['id']);
        $this->actingAs($this->user)->put(route('api.character.save.advancements'), $withoutCharacterId)->assertForbidden();

        $withoutAdvancements = $payload;
        unset($withoutAdvancements['character']['advancements']);
        $this->actingAs($this->user)->put(route('api.character.save.advancements'), $withoutAdvancements)->assertRedirect(route('index.show'));

        $withoutSchoolRank = $payload;
        unset($withoutSchoolRank['character']['school_rank']);
        $this->actingAs($this->user)->put(route('api.character.save.advancements'), $withoutSchoolRank)->assertRedirect(route('index.show'));

        $withoutSchoolStats = $payload;
        unset($withoutSchoolStats['character']['stats']);
        $this->actingAs($this->user)->put(route('api.character.save.advancements'), $withoutSchoolStats)->assertRedirect(route('index.show'));

        $withoutSchoolTechniques = $payload;
        unset($withoutSchoolTechniques['character']['techniques']);
        $this->actingAs($this->user)->put(route('api.character.save.advancements'), $withoutSchoolTechniques)->assertRedirect(route('index.show'));

        $withoutSchoolTechniqueId = $payload;
        $withoutSchoolTechniqueId['character']['techniques'] = [
            ['key' => ':)'],
        ];
        $this->actingAs($this->user)->put(route('api.character.save.advancements'), $withoutSchoolTechniqueId)->assertRedirect(route('index.show'));
    }


    public function testSaveStats(): void
    {
        $this->actingAs($this->user)
            ->put(route('api.character.save.stats'), [
                'character' => [
                    'id' => $this->character->getKey(),
                    'stats' => [
                        'rings' => [
                            'air' => 1,
                            'earth' => 2,
                            'fire' => 3,
                            'void' => 4,
                            'water' => 5,
                        ],
                        'social' => [
                            'honor' => 1,
                            'glory' => 2,
                            'status' => 3,
                        ],
                        'conflict' => [
                            'strife' => 0,
                            'fatigue' => 0,
                            'void_points' => 0,
                        ],
                    ],
                ],
            ])
            ->assertOk();

            $this->character->refresh();
            self::assertSame(1, $this->character->stats['rings']['air']);
            self::assertSame(2, $this->character->stats['rings']['earth']);
            self::assertSame(3, $this->character->stats['rings']['fire']);
            self::assertSame(4, $this->character->stats['rings']['void']);
            self::assertSame(5, $this->character->stats['rings']['water']);

            self::assertSame(1, $this->character->stats['social']['honor']);
            self::assertSame(2, $this->character->stats['social']['glory']);
            self::assertSame(3, $this->character->stats['social']['status']);
    }


    public function testSaveWithCampaignUpdate(): void
    {
        $this->expectsEvents(UpdateCharacterEvent::class);

        $campaign = Campaign::factory()->create();
        $campaign->characters()->attach($this->character->getKey());

        $this->actingAs($this->user)
            ->put(route('api.character.save.stats'), [
                'character' => [
                    'id' => $this->character->getKey(),
                    'stats' => [
                        'rings' => [
                            'air' => 1,
                            'earth' => 2,
                            'fire' => 3,
                            'void' => 4,
                            'water' => 5,
                        ],
                        'social' => [
                            'honor' => 1,
                            'glory' => 2,
                            'status' => 3,
                        ],
                        'conflict' => [
                            'strife' => 0,
                            'fatigue' => 0,
                            'void_points' => 0,
                        ],
                    ],
                ],
            ])
            ->assertOk();
    }


    public function testSaveInventoryWithShouldRemove(): void
    {
        $containerId = Uuid::uuid6()->toString();
        $item = Item::factory()->create();

        $this->character->update([
            'inventory' => [
                'containers' => [
                    [
                        'id' => $containerId,
                        'name' => 'container name',
                        'items' => [
                            [
                                'key' => $item->key,
                                'quantity' => 1,
                            ],
                        ],
                    ],
                ],
            ],
        ]);
        self::assertCount(1, $this->character->inventory['containers'][0]['items']);

        $this->actingAs($this->user)
            ->put(route('api.character.save.inventory'), [
                'character' => [
                    'id' => $this->character->getKey(),
                ],
                'inventory' => [
                    'containers' => [
                        [
                            'id' => Uuid::uuid6()->toString(),
                            'name' => 'Container',
                            'items' => [
                                [
                                    'item_key' => $item->key,
                                    'quantity' => 1,
                                    'shouldRemove' => true,
                                ],
                            ],
                        ],
                    ],
                ],
            ])
            ->assertOk();

        $this->character->refresh();
        self::assertEmpty($this->character->inventory['containers'][0]['items']);
    }


    public function testSaveInventoryWithCustomName(): void
    {
        $containerId = Uuid::uuid6()->toString();
        $item = Item::factory()->create();

        $this->character->update([
            'inventory' => [
                'containers' => [
                    [
                        'id' => $containerId,
                        'name' => 'container name',
                        'items' => [
                            [
                                'key' => $item->key,
                                'quantity' => 1,
                            ],
                        ],
                    ],
                ],
            ],
        ]);
        self::assertFalse(array_key_exists('custom_name', $this->character->inventory['containers'][0]['items'][0]));

        $this->actingAs($this->user)
            ->put(route('api.character.save.inventory'), [
                'character' => [
                    'id' => $this->character->getKey(),
                ],
                'inventory' => [
                    'containers' => [
                        [
                            'id' => Uuid::uuid6()->toString(),
                            'name' => 'Container',
                            'items' => [
                                [
                                    'item_key' => $item->key,
                                    'quantity' => 1,
                                    'custom_name' => 'Test Item',
                                ],
                            ],
                        ],
                    ],
                ],
            ])
            ->assertOk();

        $this->character->refresh();
        self::assertSame('Test Item', $this->character->inventory['containers'][0]['items'][0]['custom_name']);
    }
}
