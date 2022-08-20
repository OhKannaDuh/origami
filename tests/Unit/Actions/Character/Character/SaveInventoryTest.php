<?php

namespace Tests\Unit\Actions\Character\Character;

use App\Actions\ActionInterface;
use App\Actions\Character\Character\SaveInventory;
use App\Http\Requests\Api\Character\SaveInventoryRequest;
use App\Models\Character\Character;
use App\Models\Character\Item;
use Ramsey\Uuid\Uuid;
use Tests\Unit\Actions\ActionTestCase;

final class SaveInventoryTest extends ActionTestCase
{


    protected function getAction(): ActionInterface
    {
        return new SaveInventory();
    }


    public function providerContextException(): array
    {
        return [
            ['request', SaveInventoryRequest::class, []],
        ];
    }


    public function testExecute(): void
    {
        $item = Item::factory()->create();
        $character = Character::factory()->create();

        $action = $this->getAction();

        $request = new SaveInventoryRequest();

        $request->replace([
            'character' => [
                'id' => $character->getKey(),
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
        ]);

        $request->setLaravelSession(session());

        $response = $action->execute(['request' => $request]);
        self::assertTrue($response);

        $character->refresh();
        self::assertSame([
            'item_key' => $item->key,
            'quantity' => 5,
        ], $character->inventory['containers'][0]['items'][0]);
    }
}
