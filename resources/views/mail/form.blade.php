<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Verificação de E-mail</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-base-200 flex items-center justify-center">

    <div class="card w-full max-w-md bg-base-100 shadow-xl">
        <div class="card-body">

            <h2 class="card-title justify-center">
                Verifique seu e-mail 📧
            </h2>

            <p class="text-center text-sm text-base-content/70">
                Enviamos um código de verificação para:
                <br>
                <strong>{{ auth()->user()->email }}</strong>
            </p>

            <form method="POST" action="{{ route('verification.verify') }}" class="space-y-4 mt-4">
                @csrf

                <input
                    type="text"
                    name="code"
                    maxlength="6"
                    inputmode="numeric"
                    placeholder="000000"
                    class="input input-bordered w-full text-center text-lg tracking-widest"
                    required
                    autofocus
                >

                @error('code')
                    <p class="text-error text-sm text-center">
                        {{ $message }}
                    </p>
                @enderror

                <button type="submit" class="btn btn-primary w-full">
                    Confirmar código
                </button>
            </form>

            <div class="divider"></div>

            <div class="text-center text-sm">
                Não recebeu o código?
                <a href="#" class="link link-primary">
                    Reenviar
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success mt-4">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

        </div>
    </div>

</body>
</html>
