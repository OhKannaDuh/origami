<?php

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\CampaignRequest;
use App\Models\Core\Campaign;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class ViewController extends Controller
{


    protected function show(CampaignRequest $request, Campaign $campaign): Response
    {
        return Inertia::render('Campaign/View', [
            'campaign' => $campaign->load([
                'characters.clan',
                'characters.family',
                'characters.school',
            ]),
            'characters' => $request->user()?->characters,
        ]);
    }
}
