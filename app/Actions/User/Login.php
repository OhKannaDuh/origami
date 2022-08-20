<?php

namespace App\Actions\User;

use App\Http\Requests\Auth\LoginRequest;
use App\StringHelper;
use Carbon\Carbon;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Cache\RateLimiter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

final class Login implements LoginInterface
{


    public function __construct(
        private RateLimiter $limiter,
    ) {
    }


    public function execute(array $context = []): RedirectResponse
    {
        $request = $context['request'] ?? null;
        assert($request instanceof LoginRequest);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->throttle($request);
        }

        $login = Auth::guard()->attempt($request->only(['email', 'password']));
        if ($login && $request->hasSession()) {
            return $this->success($request);
        }

        throw $this->failed($request);
    }


    private function success(Request $request): RedirectResponse
    {
        $request->session()->put('auth.password_confirmed_at', Carbon::now()->timestamp);

        $key = $this->getLimiterKey($request);
        $this->limiter->clear($key);

        return Redirect::route('index.show');
    }


    private function failed(Request $request): ValidationException
    {
        $key = $this->getLimiterKey($request);
        $this->limiter->hit($key, 60);

        return ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }


    private function throttle(Request $request): void
    {
        event((new Lockout($request)));

        $key = $this->getLimiterKey($request);
        $seconds = $this->limiter->availableIn($key);

        throw ValidationException::withMessages([
            'email' => [
                trans('auth.throttle', [
                    'seconds' => $seconds,
                ])
            ],
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }


    private function getLimiterKey(Request $request): string
    {
        $key = implode('|', [
            $request->input('email'),
            $request->ip(),
        ]);

        return StringHelper::transliterate(StringHelper::lower($key));
    }


    private function hasTooManyLoginAttempts(Request $request): bool
    {
        $key = $this->getLimiterKey($request);
        return $this->limiter->tooManyAttempts($key, 5);
    }
}
