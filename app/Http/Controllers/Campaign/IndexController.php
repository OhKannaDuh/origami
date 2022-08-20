<?php

namespace App\Http\Controllers\Campaign;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class IndexController extends Controller
{


    protected function show(Request $request): Response
    {
        /** @var User $user */
        $user = $request->user();

        /** @var Collection $campaigns */
        $campaigns = $user->campaigns;
        $campaigns->loadCount(['characters']);

        return Inertia::render('Campaign/Index', [
            'campaigns' => $campaigns,
        ]);
    }
}
