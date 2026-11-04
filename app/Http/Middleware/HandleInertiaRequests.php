<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        if($this->AuthMaster($request)['master'] && $this->AuthMaster($request)['master']->is_active) {
            return array_merge(parent::share($request), [
                'auth' => $this->AuthMaster($request),
            ]);
        } else {
            return array_merge(parent::share($request), [
                'auth' => $this->AuthUser($request),
            ]);
        }
    }

    public function AuthMaster(Request $request): array
    {
        $guard = Auth::guard('master');
        $user = $guard->user();
        $userSettings = $user ? $user->settings : null;
        return [
            'master' => $user,
            'userSettings' => $userSettings,
        ];
    }

    public function AuthUser(Request $request): array
    {
        return [
            'user' => $request->user(),
        ];
    }
}
