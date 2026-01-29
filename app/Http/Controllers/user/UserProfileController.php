<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\PasswordUpdateRequest;
use App\Http\Requests\user\UserProfileRequest;
use Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
        $user = auth()->user();
        return view('profile.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
        $user = auth()->user();
        return view('profile.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserProfileRequest $request)
    {
        $user = auth()->user();
        $user->update($request->validated()); 

        return redirect()->route('profile.show')->with(['success' => 'Perfil atualizado com sucesso']);
    }

    public function password()
    {
        return view('profile.password.edit');
    }

    public function update_password(PasswordUpdateRequest $request)
    {
        $validate = $request->validated();

        $user = auth()->user();

        if($user->password)
        {
            // Senha atual incorreta
            if(!Hash::check($validate['current_password'], $user->password))
            {
                return back()->withErrors([
                    'current_password' => 'Senha atual incorreta',
                ]);
            }

            // Nova senha eh igual a senha antiga)
            if(Hash::check($validate['password'], $user->password))
            {
                return back()->withErrors([
                    'password' => 'Nova senha não pode ser igual a senha anterior',
                ]);              
            }
        }
        
        // Atualiza a senha
        $user->update([
            'password' => Hash::make($validate['password']),
        ]);

        return back()->with(['success' => 'Senha atualizada com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        $user = auth()->user();

        Auth::logout();

        $user->delete();

        return redirect()->route('login');
    }
}
