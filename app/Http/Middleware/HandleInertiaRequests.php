<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';


    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return vite()->getHash();
    }


    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'versions' => [
                'php' => PHP_VERSION,
                'laravel' => \Illuminate\Foundation\Application::VERSION,
            ],
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
            ],
            'auth.user' => fn () => $request->user()
                ? $this->getUserData($request->user())
                : null,
        ]);
    }


    private function getUserData(User $user): array
    {
        return array_merge(
            $user->only('id', 'name', 'email'),
            ['avatar' => $user->getAvatarUrl()],
        );
    }
}
