<?php

namespace App\Actions\Character\Character;

use App\Http\Requests\Api\Character\SaveStatsRequest;
use App\Repositories\Character\CharacterRepositoryInterface;

final class SaveStats implements SaveStatsInterface
{


    public function execute(array $context = []): int
    {
        $request = $context['request'] ?? null;
        assert($request instanceof SaveStatsRequest);

        $repository = $context['repository'] ?? null;
        assert($repository instanceof CharacterRepositoryInterface);

        $repository->updateStats($request->character(), $request->stats());

        return $request->sendUpdate();
    }
}
