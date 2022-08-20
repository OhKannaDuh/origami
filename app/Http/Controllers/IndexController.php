<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

final class IndexController extends Controller
{


    protected function show(): Response
    {
        return Inertia::render('Index');
    }
}
