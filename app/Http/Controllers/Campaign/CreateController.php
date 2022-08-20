<?php

namespace App\Http\Controllers\Campaign;

use App\Actions\Core\Campaign\CreateInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\CreateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

final class CreateController extends Controller
{


    protected function show(): Response
    {
        return Inertia::render('Campaign/Create');
    }


    protected function create(CreateRequest $request, CreateInterface $action): RedirectResponse
    {
        $campaign = $action->execute(['request' => $request]);

        return Redirect::route('campaign.view.show', [
            'campaign' => $campaign->uuid,
        ]);
    }
}
