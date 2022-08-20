<?php

namespace App\Http\Controllers\Character;

use App\Http\Controllers\Controller;
use App\Http\Requests\Character\CampaignRequest;
use App\Http\Requests\Character\CharacterRequest;
use App\Models\Character\Character;
use App\Models\Core\Campaign;
use Inertia\Inertia;
use Inertia\Response;

final class ViewController extends Controller
{


    protected function show(CharacterRequest $request, Character $character): Response
    {
        return Inertia::render('Character/View', [
            'characterData' => $this->loadCharacter($character),
        ]);
    }


    protected function campaign(CampaignRequest $request, Character $character, Campaign $campaign): Response
    {
        return Inertia::render('Character/View', [
            'characterData' => $this->loadCharacter($character),
            'campaignData' => $campaign->load([
                'characters.clan',
                'characters.family',
                'characters.school',
            ]),
        ]);
    }


    private function loadCharacter(Character $character): Character
    {
        return $character->load([
            'advantages.advantageType',
            'advantages.ring',
            'campaigns',
            'clan',
            'disadvantages.disadvantageType',
            'disadvantages.ring',
            'family',
            'school.availableTechniqueTypes',
            'school.availableTechniqueSubtypes',
            'techniques',
        ]);
    }
}
