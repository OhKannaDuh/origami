<?php

namespace App\Actions\Character\Character;

use App\Http\Requests\Character\CreateRequest;
use App\Models\Character\Character;
use App\Repositories\Character\CharacterRepositoryInterface;
use Ramsey\Uuid\Uuid;

final class Create implements CreateInterface
{


    public function __construct(
        private CharacterRepositoryInterface $characters
    ) {
    }


    public function execute(array $context = []): Character
    {
        $request = $context['request'] ?? null;
        assert($request instanceof CreateRequest);

        // Get data from request
        $data = $request->getAttributes();

        // Merge with post process data
        $data = array_merge($data, [
            'uuid' => Uuid::uuid6()->toString(),
            'user_id' => $request->user()?->getKey(),
            'school_rank' => 1,
            'inventory' => [
                'containers' => [
                    [
                        'id' => Uuid::uuid6()->toString(),
                        'name' => 'Inventory',
                        'items' => $request->getStartingItems(),
                    ],
                    [
                        'id' => Uuid::uuid6()->toString(),
                        'name' => 'Traveling Pack',
                        'items' => $request->getTravelingPackItems(),
                    ],
                ],
            ],
            'advancements' => [
                'xp' => [
                    'total' => 0,
                    'spent' => 0,
                ],
                'advancements' => [],
            ],
        ]);

        $data['stats']['skills'] = $request->getSkills();

        $character = $this->characters->create($data);
        assert($character instanceof Character);

        $character->advantages()->attach($request->getAdvantages());
        $character->disadvantages()->attach($request->getDisadvantages());
        $character->techniques()->attach($request->getTechniques());

        return $character;
    }
}
