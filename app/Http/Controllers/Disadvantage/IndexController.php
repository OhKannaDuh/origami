<?php

namespace App\Http\Controllers\Disadvantage;

use App\Http\Controllers\Controller;
use App\Repositories\Character\DisadvantageRepositoryInterface;
use Inertia\Inertia;
use Inertia\Response;

final class IndexController extends Controller
{


    protected function show(DisadvantageRepositoryInterface $repository): Response
    {
        $disadvantages = $repository->all();
        $disadvantages->load([
            'sourceBook',
            'ring',
            'disadvantageType',
            'disadvantageCategories',
        ]);

        return Inertia::render('Disadvantage/Index', [
            'disadvantages' => $disadvantages,
        ]);
    }
}
