<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\mail\SendResetLinkEmailRequest;
use App\Mail\ResetPasswordLinkMailMessage;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Mail;
use PharIo\Manifest\Url;
use Str;

class ForgotPasswordController extends Controller
{
    //
    public function showLinkRequestForm()
    {
        return view('profile.password.request');
    }

    public function sendResetLinkEmail(SendResetLinkEmailRequest $request)
    {
        $request->validated();

        $user = User::where('email', $request->email)->first();

        // Caso não exista usuario com este email
        if(!$user)
        {
            return back()->withErrors(['email', 'Email inválido']);
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => $token,
                'created_at' => Carbon::now(),
            ]
        );

        $link = route('password.reset', ['token' => $token, 'email' => $user->email]);

        Mail::to($user->email)->send(new ResetPasswordLinkMailMessage($link));

        return back()->with('status', 'Link de redefinição de senha enviado');
    }
}
