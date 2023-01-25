<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Repositories\Character\SchoolRepositoryInterface;
use Inertia\Inertia;
use Inertia\Response;

final class IndexController extends Controller
{


    protected function show(SchoolRepositoryInterface $repository): Response
    {
        return Inertia::render('School/Index', [
            'schools' => $repository->all(),
        ]);
    }
}
