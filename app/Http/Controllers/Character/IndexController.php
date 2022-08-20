<?php

namespace App\Http\Controllers\Character;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class IndexController extends Controller
{


    protected function show(Request $request): Response
    {
        $user = $request->user();
        return Inertia::render('Character/Index', [
            'characters' => $user?->characters->load([
                'clan',
                'family',
                'school',
            ]),
        ]);
    }
}
