<?php

namespace Tests\Unit\Http\Requests\Api\Character;

use App\Http\Requests\Api\Character\SaveInventoryRequest;
use App\Http\Requests\Request;
use App\Models\Character\Character;
use App\Models\Character\Item;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Tests\Unit\Http\Requests\RequestTest;

final class SaveInventoryRequestTest extends RequestTest
{
    private User $user;

    private Character $character;

    private string $uuidOne = '';

    private string $uuidTwo = '';


    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->character = Character::factory()->create();

        $this->character->user()->associate($this->user);

        $this->uuidOne = Uuid::uuid6()->toString();
        $this->uuidTwo = Uuid::uuid6()->toString();
    }


    public function providerRequiredRules(): array
    {
        return [
            ['inventory'],
            ['inventory.containers'],
            ['inventory.containers.0.id'],
            ['inventory.containers.0.name'],
        ];
    }


    /**
     * @return class-string<Request>&string
     */
    protected function getRequestClass(): string
    {
        return SaveInventoryRequest::class;
    }


    protected function getPayload(): array
    {
        return [
            'character' => [
                'id' => $this->character->getKey(),
            ],
            'inventory' => [
                'containers' => [
                    [
                        'id' => $this->uuidOne,
                        'name' => 'Test',
                        'items' => [],
                    ],
                    [
                        'id' => $this->uuidTwo,
                        'name' => 'Test 2',
                        'items' => [],
                    ],
                ],
                /**
                 * If we remove inventory.containers to ensure it is required, we instead fail on inventory
                 * to avoid this we add this dummy item to prevent inventory being left empty and invalid.
                 */
                '_dummy' => 'dummy',
            ],
        ];
    }


    protected function getUser(): User
    {
        return $this->user;
    }


    public function testContainers(): void
    {
        $items = Item::factory(10)->create();

        $payload = $this->getPayload();
        $payload['inventory']['containers'][0]['items'] = [
            [
                'item_key' => $items[0]->getKey(),
                'quantity' => 10,
            ],
            [
                'item_key' => $items[1]->getKey(),
                'quantity' => 13,
            ],
            [
                'item_key' => $items[2]->getKey(),
                'quantity' => 21,
            ],
            [
                'item_key' => $items[3]->getKey(),
                'quantity' => 99,
                'shouldRemove' => true,
            ],
            [
                'item_key' => $items[5]->getKey(),
                'quantity' => 5,
                'custom_name' => 'Test Item',
            ],
        ];


        $payload['inventory']['containers'][1]['items'] = [
            [
                'item_key' => $items[6]->getKey(),
                'quantity' => 21,
            ],
        ];

        $request = $this->getRequest($payload);
        assert($request instanceof SaveInventoryRequest);

        self::assertCount(2, $request->containers());

        self::assertSame([
            [
                'item_key' => $items[0]->getKey(),
                'quantity' => 10,
            ],
            [
                'item_key' => $items[1]->getKey(),
                'quantity' => 13,
            ],
            [
                'item_key' => $items[2]->getKey(),
                'quantity' => 21,
            ],
            [
                'item_key' => $items[5]->getKey(),
                'quantity' => 5,
                'custom_name' => 'Test Item',
            ],
        ], $request->containers()[0]['items']);

        self::assertSame($this->uuidOne, $request->containers()[0]['id']);
        self::assertSame('Test', $request->containers()[0]['name']);

        self::assertSame([
            [
                'item_key' => $items[6]->getKey(),
                'quantity' => 21,
            ],
        ], $request->containers()[1]['items']);

        self::assertSame($this->uuidTwo, $request->containers()[1]['id']);
        self::assertSame('Test 2', $request->containers()[1]['name']);
    }
}
