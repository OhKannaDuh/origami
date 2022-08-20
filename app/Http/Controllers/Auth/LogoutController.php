<?php

namespace App\Http\Controllers\Auth;

use App\Actions\User\LogoutInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

final class LogoutController extends Controller
{


    protected function logout(AuthRequest $request, LogoutInterface $action): RedirectResponse|JsonResponse
    {
        return $action->execute(['request' => $request]);
    }
}
