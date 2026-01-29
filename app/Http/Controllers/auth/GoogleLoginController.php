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

        $user = User::where('google_id', $googleUser->getId())->first();

        // Se nao achar usuario logado via google
        if(!$user)
        {
            
            $user = User::where('email', $googleUser->getEmail())->first();

            // Se encontrar um email igual a tentativa com o google vincula os 2
            if($user)
            {
                $user->update([
                    'google_id' => $googleUser->getId(),
                ]);
            }
            else
            {
                // Caso contrario cria o usuario sem senha pois esta registrado via google (Na aplicação será pedido uma senha)
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => null,
                    'email_verified_at' => now(),
                ]);
            }
            
        }

        // Login do usuario
        Auth::login($user, true);

        return redirect()->route('dashboard');
    }
}
