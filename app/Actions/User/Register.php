<?php

namespace App\Actions\User;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

final class Register implements RegisterInterface
{


    public function __construct(
        private CreateInterface $creator,
    ) {
    }


    public function execute(array $context = []): RedirectResponse
    {
        $user = $this->creator->execute($context);
        event(new Registered($user));

        Auth::guard()->login($user);

        return Redirect::route('index.show');
    }
}
