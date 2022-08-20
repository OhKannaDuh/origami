<?php

namespace App\Http\Controllers\Auth;

use App\Actions\User\RegisterInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

final class RegisterController extends Controller
{


    protected function show(): Response
    {
        return Inertia::render('Auth/Register');
    }


    protected function register(Request $request, RegisterInterface $action): RedirectResponse
    {
        return $action->execute($request->all());
    }
}
