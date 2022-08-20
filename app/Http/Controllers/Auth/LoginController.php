<?php

namespace App\Http\Controllers\Auth;

use App\Actions\User\LoginInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

final class LoginController extends Controller
{


    protected function show(): Response
    {
        return Inertia::render('Auth/Login');
    }


    protected function login(LoginRequest $request, LoginInterface $action): RedirectResponse
    {
        return $action->execute(['request' => $request]);
    }
}
