<?php

namespace App\Http\Controllers\Character;

use App\Actions\Character\Character\CopyInterface;
use App\Http\Controllers\Controller;
use App\Models\Character\Character;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

final class CopyController extends Controller
{


    protected function copy(Character $character, CopyInterface $action): RedirectResponse
    {
        $action->execute(['character' => $character]);

        return Redirect::route('character.index.show');
    }
}
