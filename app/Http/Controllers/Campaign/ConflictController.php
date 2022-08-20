<?php

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\OwnerRequest;
use App\Models\Core\Campaign;
use Inertia\Inertia;
use Inertia\Response;

final class ConflictController extends Controller
{


    protected function show(OwnerRequest $request, Campaign $campaign): Response
    {
        return Inertia::render('Campaign/Conflict', [
            'campaignData' => $campaign->load([
                'characters',
            ]),
        ]);
    }
}
