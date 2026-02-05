<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\PasswordUpdateRequest;
use App\Http\Requests\user\UserProfileRequest;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class UserProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
        $user = auth()->user();
        return Inertia::render('Profile/Show',['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
        $user = auth()->user();
        return Inertia::render('Profile/Edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserProfileRequest $request)
    {
        $user = auth()->user();

        // Coleta as informações, exceto profile_image e transforma em um vetor
        $data = collect($request->validated())
        ->except('profile_image')
        ->toArray();

        if($request->hasFile('profile_image')) 
        {

            if($user->profile_image) 
            {
                Storage::disk('public')->delete($user->profile_image);
            }

            $data['profile_image'] = $request
            ->file('profile_image')
            ->store('profile_images', 'public');
        }

        $user->update($data);

        return redirect()->route('profile.show')->with(['success' => 'Perfil atualizado com sucesso']);
    }

    public function password()
    {
        return Inertia::render('Profile/Password/Edit', ['hasLocalPassword' => auth()->user()->has_local_password]);
    }

    public function update_password(PasswordUpdateRequest $request)
    {
        $validate = $request->validated();

        $user = auth()->user();
        
        if($user->has_local_password)
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
        
        // Atualiza a senha e marca o usuario pois agora o mesmo tem uma senha local
        $user->update([
            'password' => Hash::make($validate['password']),
            'has_local_password' => true,
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
