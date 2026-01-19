<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Laravel\Socialite\Facades\Socialite;
use Str;

class GoogleLoginController extends Controller
{
    //
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        if(!$user)
        {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),

                // Senha aleatoria, usuario não vai usar mesmo
                'password' => bcrypt(Str::random(32)),
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user, true);

        return redirect()->route('dashboard');
    }
}
