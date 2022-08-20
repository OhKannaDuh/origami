<?php

namespace Tests\Unit\Http\Requests\Character;

use App\Http\Requests\Campaign\OwnerRequest;
use App\Http\Requests\Character\CreateRequest;
use App\Models\Character\Advantage;
use App\Models\Character\Clan;
use App\Models\Character\Disadvantage;
use App\Models\Character\Family;
use App\Models\Character\Item;
use App\Models\Character\School;
use App\Models\Character\Technique;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Tests\Unit\Http\Requests\RequestTest;

use function PHPUnit\Framework\assertSame;

final class CreateRequestTest extends RequestTest
{
    private User $user;

    private Collection $items;


    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->items = Item::factory(3)->create();
    }


    public function providerRequiredRules(): array
    {
        return [
            ['character.name'],
            ['character.clan.id'],
            ['character.family.id'],
            ['character.school.id'],
            ['character.school.starting_techniques'],
            ['character.honor'],
            ['character.glory'],
            ['character.status'],
            ['character.rings.air.rank'],
            ['character.rings.earth.rank'],
            ['character.rings.fire.rank'],
            ['character.rings.void.rank'],
            ['character.rings.water.rank'],
            ['character.distinction.id'],
            ['character.passion.id'],
            ['character.adversity.id'],
            ['character.anxiety.id'],
            [
                'character.school.starting_techniques.Kata-1.type',
                'The character.school.starting_techniques.Kata-1.type',
            ],
            [
                'character.otherRelationships.item.key',
                'The character.other relationships.item.key field is required.',
            ],
            [
                'character.school.starting_outfit.0.type',
                'The character.school.starting_outfit.0.type field is required.',
            ],
        ];
    }


    protected function getRequestClass(): string
    {
        return CreateRequest::class;
    }


    protected function getPayload(): array
    {
        $clan = Clan::factory()->create();
        $family = Family::factory()->create();
        $school = School::factory()->create();

        $distinction = Advantage::factory()->create();
        $passion = Advantage::factory()->create();

        $adversity = Disadvantage::factory()->create();
        $anxiety = Disadvantage::factory()->create();

        return [
            'character' => [
                'name' => 'Test Character',
                'clan' => ['id' => $clan->getKey()],
                'family' => ['id' => $family->getKey()],
                'school' => [
                    'id' => $school->getKey(),
                    'starting_outfit' => [
                        [
                            'type' => 'item',
                            'item_key' => $this->items[0]->key,
                        ],
                        [
                            'type' => 'item',
                            'item_key' => $this->items[1]->key,
                        ],
                    ],
                    'starting_techniques' => [
                        'Kata-1' => [
                            'type' => 'group',
                            'techniques' => [],
                        ],
                        'Kata-2' => [
                            'type' => 'group',
                            'techniques' => [],
                        ],
                    ],
                ],
                'honor' => 65,
                'glory' => 50,
                'status' => 45,
                'otherRelationships' => [
                    'item' => ['key' => $this->items[2]->key],
                ],
                'rings' => [
                    'air' => ['rank' => 4],
                    'earth' => ['rank' => 1],
                    'fire' => ['rank' => 2],
                    'water' => ['rank' => 3],
                    'void' => ['rank' => 3],
                ],
                'distinction' => ['id' => $distinction->getKey()],
                'passion' => ['id' => $passion->getKey()],
                'adversity' => ['id' => $adversity->getKey()],
                'anxiety' => ['id' => $anxiety->getKey()],
            ],
        ];
    }


    protected function getUser(): User
    {
        return $this->user;
    }


    public function testGetAttributes1(): void
    {
        $payload = $this->getPayload();

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $attributes = $request->getAttributes();
        self::assertSame('Test Character', $attributes['name']);
        self::assertSame(Arr::get($payload, 'character.clan.id'), $attributes['clan_id']);
        self::assertSame(Arr::get($payload, 'character.family.id'), $attributes['family_id']);
        self::assertSame(Arr::get($payload, 'character.school.id'), $attributes['school_id']);

        self::assertSame('', Arr::get($attributes, 'personality.lord'));
        self::assertSame('', Arr::get($attributes, 'personality.giri'));
        self::assertSame('', Arr::get($attributes, 'personality.ninjo'));
        self::assertSame('', Arr::get($attributes, 'personality.first_notice'));
        self::assertSame('', Arr::get($attributes, 'personality.stress'));
        self::assertSame('', Arr::get($attributes, 'personality.death'));

        $relationships = Arr::get($attributes, 'personality.relationships');
        self::assertCount(3, $relationships);
        self::assertSame('', Arr::join($relationships, ''));

        self::assertEmpty($attributes['heritage']);

        self::assertSame(4, Arr::get($attributes, 'stats.rings.air'));
        self::assertSame(1, Arr::get($attributes, 'stats.rings.earth'));
        self::assertSame(2, Arr::get($attributes, 'stats.rings.fire'));
        self::assertSame(3, Arr::get($attributes, 'stats.rings.water'));
        self::assertSame(3, Arr::get($attributes, 'stats.rings.void'));

        self::assertSame(65, Arr::get($attributes, 'stats.social.honor'));
        self::assertSame(50, Arr::get($attributes, 'stats.social.glory'));
        self::assertSame(45, Arr::get($attributes, 'stats.social.status'));

        self::assertSame(0, Arr::get($attributes, 'stats.conflict.strife'));
        self::assertSame(0, Arr::get($attributes, 'stats.conflict.fatigue'));
        self::assertSame(2, Arr::get($attributes, 'stats.conflict.void_points'));
    }


    public function testGetAttributes2(): void
    {
        $payload = $this->getPayload();
        Arr::set($payload, 'character.lord', 'Lord Test');
        Arr::set($payload, 'character.giri', 'Girigiri');
        Arr::set($payload, 'character.ninjo', 'Ninja ninjo');
        Arr::set($payload, 'character.firstNotice', 'Pretty cool');
        Arr::set($payload, 'character.stress', 'Nope');
        Arr::set($payload, 'character.death', 'On the field of battle');

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $attributes = $request->getAttributes();
        self::assertSame('Lord Test', Arr::get($attributes, 'personality.lord'));
        self::assertSame('Girigiri', Arr::get($attributes, 'personality.giri'));
        self::assertSame('Ninja ninjo', Arr::get($attributes, 'personality.ninjo'));
        self::assertSame('Pretty cool', Arr::get($attributes, 'personality.first_notice'));
        self::assertSame('Nope', Arr::get($attributes, 'personality.stress'));
        self::assertSame('On the field of battle', Arr::get($attributes, 'personality.death'));
    }


    public function testGetAttributes3(): void
    {
        $payload = $this->getPayload();
        Arr::set($payload, 'character.mentor.description', 'A good relationship');
        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $relationships = Arr::get($request->getAttributes(), 'personality.relationships');
        self::assertCount(3, $relationships);
        self::assertTrue(Arr::has($relationships, 'mentor'));
        self::assertSame('A good relationship', $relationships['mentor']);
    }


    public function testGetAttributes4(): void
    {
        $payload = $this->getPayload();
        Arr::set($payload, 'character.otherRelationships.description', 'An okay relationship');
        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $relationships = Arr::get($request->getAttributes(), 'personality.relationships');
        self::assertCount(3, $relationships);
        self::assertTrue(Arr::has($relationships, 'otherRelationships'));
        self::assertSame('An okay relationship', $relationships['otherRelationships']);
    }


    public function testGetAttributes5(): void
    {
        $payload = $this->getPayload();
        Arr::set($payload, 'character.parentRelationship.description', 'Terrible :C');
        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $relationships = Arr::get($request->getAttributes(), 'personality.relationships');
        self::assertCount(3, $relationships);
        self::assertTrue(Arr::has($relationships, 'parentRelationship'));
        self::assertSame('Terrible :C', $relationships['parentRelationship']);
    }


    public function testGetAttributes7(): void
    {
        $payload = $this->getPayload();
        Arr::set($payload, 'character.heritage', [
            [
                'type' => 'test',
            ],
        ]);
        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $attributes = $request->getAttributes();
        self::assertCount(1, $attributes['heritage']);
        self::assertSame(['type' => 'test'], $attributes['heritage'][0]);
    }


    public function testGetSkills1(): void
    {
        $payload = $this->getPayload();

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        self::assertEmpty($request->getSkills());
    }


    public function testGetSkills2(): void
    {
        $payload = $this->getPayload();
        Arr::set($payload, 'character.skills', [
            'test_skill' => [
                'rank' => 2,
            ],
            'other_skill' => [
                'rank' => 5,
            ],
        ]);

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $skills = $request->getSkills();
        self::assertCount(2, $skills);
        self::assertSame(2, $skills['test_skill']);
        self::assertSame(5, $skills['other_skill']);
    }


    public function testGetStartingItems1(): void
    {
        $payload = $this->getPayload();

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $items = $request->getStartingItems();
        self::assertCount(3, $items);

        self::assertSame($this->items[0]->key, $items[0]['item_key']);
        self::assertSame($this->items[1]->key, $items[1]['item_key']);
        self::assertSame($this->items[2]->key, $items[2]['item_key']);

        self::assertSame(1, $items[0]['quantity']);
        self::assertSame(1, $items[1]['quantity']);
        self::assertSame(1, $items[2]['quantity']);
    }


    public function testGetStartingItems2(): void
    {
        $payload = $this->getPayload();
        Arr::set($payload, 'character.school.starting_outfit.0.quantity', 3);
        Arr::set($payload, 'character.school.starting_outfit.1.quantity', 5);

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $items = $request->getStartingItems();

        self::assertSame(3, $items[0]['quantity']);
        self::assertSame(5, $items[1]['quantity']);
    }


    public function testGetStartingItems3(): void
    {
        $payload = $this->getPayload();
        $payload['character']['school']['starting_outfit']['the-choice'] = [
            'type' => 'choice',
        ];

        $item = Item::factory()->create();
        $payload['character']['school']['outfit']['the-choice'] = [
            [
                'key' => $item->key,
            ],
        ];

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $items = $request->getStartingItems();
        self::assertCount(4, $items);

        self::assertSame($this->items[0]->key, $items[0]['item_key']);
        self::assertSame($this->items[1]->key, $items[1]['item_key']);
        self::assertSame($item->key, $items[2]['item_key']);
        self::assertSame($this->items[2]->key, $items[3]['item_key']);

        self::assertSame(1, $items[0]['quantity']);
        self::assertSame(1, $items[1]['quantity']);
        self::assertSame(1, $items[2]['quantity']);
        self::assertSame(1, $items[3]['quantity']);
    }


    public function testGetStartingItems4(): void
    {
        $payload = $this->getPayload();
        $payload['character']['school']['starting_outfit'][] = [
            'type' => 'daisho',
        ];

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $items = $request->getStartingItems();
        self::assertCount(5, $items);

        self::assertSame($this->items[0]->key, $items[0]['item_key']);
        self::assertSame($this->items[1]->key, $items[1]['item_key']);
        self::assertSame('katana', $items[2]['item_key']);
        self::assertSame('wakizashi', $items[3]['item_key']);
        self::assertSame($this->items[2]->key, $items[4]['item_key']);


        self::assertSame(1, $items[2]['quantity']);
        self::assertSame(1, $items[3]['quantity']);
    }


    public function testGetStartingItems5(): void
    {
        $payload = $this->getPayload();
        Arr::set($payload, 'character.heritage', [
            [
                'item' => [
                    'key' => 'test_item',
                ],
            ],
            [
                'item' => [
                    'key' => 'test_item_again',
                ],
            ],
        ]);

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $items = $request->getStartingItems();
        self::assertCount(5, $items);

        self::assertSame($this->items[0]->key, $items[0]['item_key']);
        self::assertSame($this->items[1]->key, $items[1]['item_key']);
        self::assertSame('test_item', $items[2]['item_key']);
        self::assertSame('test_item_again', $items[3]['item_key']);
        self::assertSame($this->items[2]->key, $items[4]['item_key']);

        self::assertSame(1, $items[2]['quantity']);
        self::assertSame(1, $items[3]['quantity']);
    }


    public function testGetTravelingPackItems1(): void
    {
        $payload = $this->getPayload();

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $items = $request->getTravelingPackItems();
        self::assertEmpty($items);
    }


    public function testGetTravelingPackItems2(): void
    {
        $payload = $this->getPayload();
        Arr::set($payload, 'character.school.outfit.traveling_pack', []);

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $items = $request->getTravelingPackItems();
        self::assertCount(5, $items);

        self::assertSame('blanket', $items[0]['item_key']);
        self::assertSame('bowl', $items[1]['item_key']);
        self::assertSame('chopsticks', $items[2]['item_key']);
        self::assertSame('traveling_rations', $items[3]['item_key']);
        self::assertSame('flint_and_tinder', $items[4]['item_key']);

        self::assertSame(1, $items[0]['quantity']);
        self::assertSame(1, $items[1]['quantity']);
        self::assertSame(1, $items[2]['quantity']);
        self::assertSame(4, $items[3]['quantity']);
        self::assertSame(1, $items[4]['quantity']);
    }


    public function testGetTravelingPackItems3(): void
    {
        $payload = $this->getPayload();
        Arr::set($payload, 'character.school.outfit.traveling_pack', [
            [
                'key' => 'test_item',
            ],
            [
                'key' => 'second_item',
            ],
            [
                'key' => 'a_third_item',
            ],
        ]);

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $items = $request->getTravelingPackItems();
        self::assertCount(8, $items);

        self::assertSame('blanket', $items[0]['item_key']);
        self::assertSame('bowl', $items[1]['item_key']);
        self::assertSame('chopsticks', $items[2]['item_key']);
        self::assertSame('traveling_rations', $items[3]['item_key']);
        self::assertSame('flint_and_tinder', $items[4]['item_key']);
        self::assertSame('test_item', $items[5]['item_key']);
        self::assertSame('second_item', $items[6]['item_key']);
        self::assertSame('a_third_item', $items[7]['item_key']);

        self::assertSame(1, $items[0]['quantity']);
        self::assertSame(1, $items[1]['quantity']);
        self::assertSame(1, $items[2]['quantity']);
        self::assertSame(4, $items[3]['quantity']);
        self::assertSame(1, $items[4]['quantity']);
        self::assertSame(1, $items[5]['quantity']);
        self::assertSame(1, $items[6]['quantity']);
        self::assertSame(1, $items[7]['quantity']);
    }


    public function testGetAdvantages1(): void
    {
        $payload = $this->getPayload();

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $advantages = $request->getAdvantages();
        self::assertCount(2, $advantages);
        self::assertSame([
            Arr::get($payload, 'character.distinction.id'),
            Arr::get($payload, 'character.passion.id'),
        ], $advantages);
    }


    public function testGetAdvantages2(): void
    {
        $payload = $this->getPayload();
        $advantage = Advantage::factory()->create();
        Arr::set($payload, 'character.mentor.advantage.id', $advantage->getKey());

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $advantages = $request->getAdvantages();
        self::assertCount(3, $advantages);
        self::assertSame([
            Arr::get($payload, 'character.distinction.id'),
            Arr::get($payload, 'character.passion.id'),
            $advantage->getKey(),
        ], $advantages);
    }


    public function testGetAdvantages3(): void
    {
        $payload = $this->getPayload();
        $advantages = Advantage::factory(2)->create();
        Arr::set($payload, 'character.heritage', [
            [
                'effect' => [
                    'advantage' => [
                        'id' => $advantages[0]->getKey(),
                    ],
                ],
            ],
            [
                'effect' => [
                    'advantage' => [
                        'id' => $advantages[1]->getKey(),
                    ],
                ],
            ],
        ]);

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $requestAdvantages = $request->getAdvantages();
        self::assertCount(4, $requestAdvantages);
        self::assertSame([
            Arr::get($payload, 'character.distinction.id'),
            Arr::get($payload, 'character.passion.id'),
            $advantages[0]->getKey(),
            $advantages[1]->getKey(),
        ], $requestAdvantages);
    }


    public function testGetDisavantages1(): void
    {
        $payload = $this->getPayload();

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $advantages = $request->getDisadvantages();
        self::assertCount(2, $advantages);
        self::assertSame([
            Arr::get($payload, 'character.adversity.id'),
            Arr::get($payload, 'character.anxiety.id'),
        ], $advantages);
    }


    public function testGetDisavantages2(): void
    {
        $payload = $this->getPayload();
        $disadvantage = Disadvantage::factory()->create();
        Arr::set($payload, 'character.mentor.disadvantage.id', $disadvantage->getKey());

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $advantages = $request->getDisadvantages();
        self::assertCount(3, $advantages);
        self::assertSame([
            Arr::get($payload, 'character.adversity.id'),
            Arr::get($payload, 'character.anxiety.id'),
            $disadvantage->getKey(),
        ], $advantages);
    }


    public function testGetTechniques1(): void
    {
        $payload = $this->getPayload();

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        self::assertEmpty($request->getTechniques());
    }


    public function testGetTechniques2(): void
    {
        $payload = $this->getPayload();

        $techniques = Technique::factory(3)->create();
        Arr::set($payload, 'character.school.starting_techniques', [
            [
                'type' => 'group',
                'techniques' => array_column($techniques->toArray(), 'key'),
            ],
        ]);

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $requestTechniques = $request->getTechniques();
        self::assertCount(3, $requestTechniques);
        self::assertSame(array_column($techniques->toArray(), 'id'), $requestTechniques);
    }


    public function testGetTechniques3(): void
    {
        $payload = $this->getPayload();

        $techniques = Technique::factory(3)->create();
        Arr::set($payload, 'character.school.starting_techniques', [
            [
                'type' => 'choice',
            ],
        ]);

        Arr::set($payload, 'character.school.techniques', [
            [
                [
                    'key' => $techniques[0]->key,
                ],
                [
                    'key' => $techniques[1]->key,
                ],
            ],
            [
                [
                    'key' => $techniques[2]->key,
                ],
            ],
        ]);

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $requestTechniques = $request->getTechniques();
        self::assertCount(3, $requestTechniques);
        self::assertSame(array_column($techniques->toArray(), 'id'), $requestTechniques);
    }


    public function testGetTechniques4(): void
    {
        $payload = $this->getPayload();

        $techniques = Technique::factory(4)->create();
        Arr::set($payload, 'character.school.starting_techniques', [
            [
                'type' => 'choice',
            ],
            [
                'type' => 'group',
                'techniques' => [
                    $techniques[0]->key,
                ],
            ],
        ]);

        Arr::set($payload, 'character.school.techniques', [
            [
                [
                    'key' => $techniques[1]->key,
                ],
                [
                    'key' => $techniques[2]->key,
                ],
            ],
            [
                [
                    'key' => $techniques[3]->key,
                ],
            ],
        ]);

        $request = $this->getRequest($payload);
        assert($request instanceof CreateRequest);
        $this->validate($request);

        $requestTechniques = $request->getTechniques();
        self::assertCount(4, $requestTechniques);
        self::assertSame(array_column($techniques->toArray(), 'id'), $requestTechniques);
    }
}
