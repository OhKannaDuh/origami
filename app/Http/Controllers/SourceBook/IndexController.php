<?php

namespace App\Http\Controllers\SourceBook;

use App\Http\Controllers\Controller;
use App\Models\Core\SourceBook;
use Inertia\Inertia;
use Inertia\Response;

final class IndexController extends Controller
{


    protected function show(): Response
    {
        $books = SourceBook::all();
        $books->loadCount([
            'clans',
            'families',
            'techniques',
            'items',
            'schools',
            'advantages',
            'disadvantages',
        ]);

        return Inertia::render('SourceBook/Index', [
            'books' => $books,
        ]);
    }
}
