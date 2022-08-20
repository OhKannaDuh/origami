<?php

namespace App\Http\Controllers\Character;

use App\Actions\Character\Character\CreateInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Character\CreateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

final class CreateController extends Controller
{


    protected function show(): Response
    {
        return Inertia::render('Character/Create');
    }


    protected function store(CreateRequest $request, CreateInterface $action): RedirectResponse
    {
        $character = $action->execute(['request' => $request]);

        return Redirect::route('character.view.show', [
            'character' => $character->uuid,
        ]);
    }
}
