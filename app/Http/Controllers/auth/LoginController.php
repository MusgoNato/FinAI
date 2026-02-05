<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use Auth;
use Inertia\Inertia;

class LoginController extends Controller
{
    //
    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->validated();

        // Para o 'Lembrar-me'
        $remember = $request->boolean('remember');

        if(Auth::attempt($credentials, $remember)) 
        {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'message' => 'Email ou senha incorretos',
        ]);
    }
}
