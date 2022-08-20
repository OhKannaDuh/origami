<?php

namespace App\Actions\User;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

final class Logout implements LogoutInterface
{


    public function execute(array $context = []): RedirectResponse | JsonResponse
    {
        $request = $context['request'] ?? null;
        assert($request instanceof AuthRequest);

        Auth::guard()->logout();

        $request->session()->invalidate();

        return Redirect::route('index.show');
    }
}
