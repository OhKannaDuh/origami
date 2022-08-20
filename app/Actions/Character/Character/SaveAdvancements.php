<?php

namespace App\Actions\Character\Character;

use App\Http\Requests\Api\Character\SaveAdvancementsRequest;

final class SaveAdvancements implements SaveAdvancementsInterface
{


    public function execute(array $context = []): int
    {
        $request = $context['request'] ?? null;
        assert($request instanceof SaveAdvancementsRequest);

        $character = $request->character();
        $character->update([
            'advancements' => $request->advancements(),
            'school_rank' => $request->schoolRank(),
            'stats' => $request->stats(),
        ]);

        $dataTechniqueIds = array_column($request->techniques(), 'id');
        $currentTechniqueIds = array_column($character->techniques->toArray(), 'id');

        $newTechniques = array_diff($dataTechniqueIds, $currentTechniqueIds);
        $missingTechniques = array_diff($currentTechniqueIds, $dataTechniqueIds);

        $character->techniques()->attach($newTechniques);
        $character->techniques()->detach($missingTechniques);

        return $request->sendUpdate();
    }
}
