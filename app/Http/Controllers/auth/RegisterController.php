<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\RegisterRequest;
use App\Models\User;
use Auth;
use Hash;

class RegisterController extends Controller
{
    //
    public function __invoke(RegisterRequest $request)
    {
        $validation = $request->validated();

        if($validation)
        {
            $user = User::create([
                'name' => $validation['name'],
                'email' => $validation['email'],
                'password' => Hash::make($validation['password']), 
            ]);

            Auth::login($user);

            return redirect()->route('dashboard');
        }
    }
}
