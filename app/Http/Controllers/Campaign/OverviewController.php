<?php

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\OwnerRequest;
use App\Models\Core\Campaign;
use Inertia\Inertia;
use Inertia\Response;

final class OverviewController extends Controller
{


    protected function show(OwnerRequest $request, Campaign $campaign): Response
    {
        return Inertia::render('Campaign/Overview', [
            'campaign' => $campaign->load([
                'characters',
                'characters.clan',
                'characters.family',
                'characters.school',
                'characters.advantages',
                'characters.disadvantages',
                'characters.techniques',
            ]),
        ]);
    }
}
