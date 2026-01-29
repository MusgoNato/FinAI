<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<head>
    <meta charset="UTF-8">
    <title>Esqueci minha senha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-base-200">

    <div class="w-full max-w-md p-8 bg-base-100 shadow-xl rounded-xl">

        <h1 class="text-2xl font-bold text-center mb-2">
            Esqueceu sua senha?
        </h1>

        <p class="text-sm text-center text-base-content/70 mb-6">
            Informe seu e-mail e enviaremos um link para redefinir sua senha.
        </p>

        {{-- Status --}}
        @if (session('status'))
            <div class="alert alert-success mb-4 text-sm">
                {{ session('status') }}
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
            @csrf

            <div class="form-control">
                <label class="label">
                    <span class="label-text">E-mail</span>
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="input input-bordered w-full @error('email') input-error @enderror"
                    placeholder="seu@email.com"
                >

                @error('email')
                    <span class="text-error text-sm mt-1">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-full">
                Enviar link de redefinição
            </button>
        </form>

        <div class="divider"></div>

        <div class="text-center">
            <a href="{{ route('login') }}" class="link link-hover text-sm">
                Voltar para o login
            </a>
        </div>

    </div>

</body>
</html>
