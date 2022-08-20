<?php

namespace App\Http\Controllers\Character;

use App\Actions\Character\Character\DeleteInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Character\CharacterRequest;
use App\Models\Character\Character;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

final class DeleteController extends Controller
{


    protected function delete(CharacterRequest $request, Character $character, DeleteInterface $action): RedirectResponse
    {
        $action->execute(['character' => $character]);

        return Redirect::route('character.index.show');
    }
}
