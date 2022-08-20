<?php

namespace App\Actions\User;

use App\Actions\ActionInterface;
use Illuminate\Http\RedirectResponse;

interface RegisterInterface extends ActionInterface
{


    public function execute(array $context = []): RedirectResponse;
}
