<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use App\Repositories\Character\FamilyRepositoryInterface;
use Inertia\Inertia;
use Inertia\Response;

final class IndexController extends Controller
{


    protected function show(FamilyRepositoryInterface $repository): Response
    {
        return Inertia::render('Family/Index', [
            'families' => $repository->all(),
        ]);
    }
}
