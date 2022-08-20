<?php

namespace App\Actions\User;

use App\Actions\ActionInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

interface LogoutInterface extends ActionInterface
{


    public function execute(array $context = []): RedirectResponse | JsonResponse;
}
