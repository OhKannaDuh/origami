<?php

namespace App\Http\Controllers\Clan;

use App\Http\Controllers\Controller;
use App\Repositories\Character\ClanRepositoryInterface;
use Inertia\Inertia;
use Inertia\Response;

final class IndexController extends Controller
{


    protected function show(ClanRepositoryInterface $repository): Response
    {
        return Inertia::render('Clan/Index', [
            'clans' => $repository->all(),
        ]);
    }
}
