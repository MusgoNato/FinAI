<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use Auth;

class LoginController extends Controller
{
    //
    public function __invoke(LoginRequest $request)
    {
        $credentials = $request->validated();

        if(Auth::attempt($credentials)) 
        {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }

        return redirect()->route('register');
    }
}
