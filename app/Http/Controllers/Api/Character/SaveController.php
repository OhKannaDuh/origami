<?php

namespace App\Http\Controllers\Api\Character;

use App\Actions\Character\Character\SaveAdvancementsInterface;
use App\Actions\Character\Character\SaveAdvantagesInterface;
use App\Actions\Character\Character\SaveDisadvantagesInterface;
use App\Actions\Character\Character\SaveInventoryInterface;
use App\Actions\Character\Character\SaveStatsInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Character\SaveAdvancementsRequest;
use App\Http\Requests\Api\Character\SaveAdvantagesRequest;
use App\Http\Requests\Api\Character\SaveDisadvantagesRequest;
use App\Http\Requests\Api\Character\SaveInventoryRequest;
use App\Http\Requests\Api\Character\SaveStatsRequest;
use App\Repositories\Character\CharacterRepositoryInterface;

final class SaveController extends Controller
{


    protected function inventory(SaveInventoryRequest $request, SaveInventoryInterface $action): void
    {
        $action->execute(['request' => $request]);
    }


    protected function advantages(SaveAdvantagesRequest $request, SaveAdvantagesInterface $action): void
    {
        $action->execute(['request' => $request]);
    }


    protected function disadvantages(SaveDisadvantagesRequest $request, SaveDisadvantagesInterface $action): void
    {
        $action->execute(['request' => $request]);
    }


    protected function advancements(SaveAdvancementsRequest $request, SaveAdvancementsInterface $action): void
    {
        $action->execute(['request' => $request]);
    }


    protected function stats(SaveStatsRequest $request, CharacterRepositoryInterface $repository, SaveStatsInterface $action): void
    {
        $action->execute([
            'request' => $request,
            'repository' => $repository,
        ]);
    }
}
