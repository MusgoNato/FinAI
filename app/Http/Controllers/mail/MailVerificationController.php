<?php

namespace App\Http\Controllers\mail;

use App\Http\Controllers\Controller;
use App\Http\Requests\mail\CodeValidateRequest;
use App\Mail\ValidationMailMessage;
use App\Models\User;
use Cache;
use Illuminate\Http\Request;
use Mail;

class MailVerificationController extends Controller
{
    //
    public function notice()
    {
        return view('mail.notice');
    }

    public function form()
    {
        return view('mail.form');
    }

    public function verify(CodeValidateRequest $request)
    {
        $validate = $request->validated();

        $user = auth()->user();
        
        $cacheKey = 'email_verification' . $user->id;
        $storeCode = Cache::get($cacheKey);

        // Codigo expirado
        if(!$storeCode)
        {
            return back()->withErrors([
                'code' => 'Código expirado, solcite novamente',
            ]);
        }

        // Verificação dos códigos em cache e enviado via email
        if((string) $validate['code'] !== (string) $storeCode)
        {
            return back()->withErrors([
                'code' => 'Código inválido',
            ]);
        }

        // Salva o email verificado agora
        $user->forceFill([
            'email_verified_at' => now(),
        ])->save();

        // Limpa código em cache
        Cache::forget($cacheKey);

        return redirect()->route('dashboard')->with(['success' => 'Email validado com sucesso!']);
    }

    public function resend()
    {
        $code = random_int(100000, 999999);
        Cache::put(
            'email_verification' . auth()->id(),
            $code,
            now()->addMinutes(10)
        );
        Mail::to(auth()->user()->email)->send(new ValidationMailMessage($code));

        return redirect()->route('verification.form')->with('success', 'Código enviado para seu e-mail!');
    }
}
