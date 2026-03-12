<?php

namespace App\Http\Middleware;

use Cache;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function share(Request $request): array
    {
        $user = $request->user();
        $profile = null;

        if($user)
        {
            $profile = Cache::remember("user_profile_image_{$user->id}", now()->addHours(6), function () use ($user) {
                return [
                    'id'                  => $user->id,
                    'name'                => $user->name,
                    'email'               => $user->email,
                    'has_local_password'  => $user->has_local_password,
                    'email_verified_at'   => $user->email_verified_at,
                    'profile_image_url'   => $user->profile_image_url,   
                    'created_at_formatted'=> $user->created_at_formatted,
                ];
            });
        }

        return array_merge(parent::share($request), [
            'flash' => [
                'success' => fn() => $request->session()->get('success'),
                'error' => fn() => $request->session()->get('error'),
            ],
            'auth' => [
                'user' => $profile,
            ],
            'ziggy' => fn () => (new Ziggy)->toArray(),
        ]);
    }
}

