<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\user\PasswordResetRequest;
use App\Http\Requests\user\PasswordUpdateRequest;
use App\Models\User;
use DB;
use Hash;
use HashContext;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ResetPasswordController extends Controller
{
    //
    public function showResetForm(Request $request)
    {
        return Inertia::render('Profile/Password/Reset', ['email' => $request->email, 'token' => $request->token]);   
    }

    public function reset(PasswordResetRequest $request)
    {
        $validate = $request->validated();

        $record = DB::table('password_reset_tokens')
        ->where('email', $request->email)
        ->where('token', $request->token)
        ->first();

        if(!$record)
        {
            return back()->withErrors([
                'email' => 'Token inválido ou expirado',
            ]);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $user->password = Hash::make($validate['password']);
        $user->save();

        Db::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Senha redefinida com sucesso');
        
    }
}
