<?php

namespace App\Http\Controllers\Advantage;

use App\Http\Controllers\Controller;
use App\Repositories\Character\AdvantageRepositoryInterface;
use Inertia\Inertia;
use Inertia\Response;

final class IndexController extends Controller
{


    protected function show(AdvantageRepositoryInterface $repository): Response
    {
        $advantages = $repository->all();
        $advantages->load([
            'sourceBook',
            'ring',
            'advantageType',
            'advantageCategories',
        ]);

        return Inertia::render('Advantage/Index', [
            'advantages' => $advantages,
        ]);
    }
}
