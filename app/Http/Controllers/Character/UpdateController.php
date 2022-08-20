<?php

namespace App\Http\Controllers\Character;

use App\Actions\Character\Character\UpdateInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Character\CharacterRequest;
use App\Http\Requests\Character\UpdateRequest;
use App\Models\Character\Character;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

final class UpdateController extends Controller
{


    protected function show(CharacterRequest $request, Character $character): Response
    {
        return Inertia::render('Character/Update/Show', [
            'character' => $character,
        ]);
    }


    protected function update(UpdateRequest $request, Character $character, UpdateInterface $action): RedirectResponse
    {
        $character = $action->execute([
            'request' => $request,
            'character' => $character,
        ]);

        return Redirect::route('character.view.show', [
            'character' => $character->uuid,
        ]);
    }
}
