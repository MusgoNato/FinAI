<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5.0.0/dist/full.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-base-200">

    <div class="card w-full max-w-md shadow-xl bg-base-100">
        <div class="card-body">
            <h2 class="card-title justify-center text-2xl">Redefinir Senha 🔒</h2>
            <p class="text-center text-sm text-base-content/70 mb-4">
                Insira sua nova senha para continuar
            </p>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <!-- Token escondido -->
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <!-- Senha -->
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Nova senha</span>
                    </label>
                    <input type="password" name="password" placeholder="Digite a nova senha" class="input input-bordered w-full" required>
                    @error('password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirmação de senha -->
                <div class="form-control mb-4">
                    <label class="label">
                        <span class="label-text">Confirmar senha</span>
                    </label>
                    <input type="password" name="password_confirmation" placeholder="Repita a senha" class="input input-bordered w-full" required>
                </div>

                <button type="submit" class="btn btn-primary w-full">Redefinir Senha</button>

                @if(session('status'))
                    <div class="alert alert-success mt-4">
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error mt-4">
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

            </form>
        </div>
    </div>

</body>
</html>
