<x-layout title="Login">
    <div class="card w-full max-w-md shadow-2xl">
        <div class="card-body">

            <!-- Cabeçalho -->
            <div class="text-center">
                <h1 class="text-3xl font-bold text-primary">
                    Controle Financeiro
                </h1>
                <p class="text-sm text-base-content/70 mt-1">
                    Acesse sua conta para gerenciar suas finanças
                </p>
            </div>

            <!-- Formulário -->
            <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-4">
                @csrf

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">E-mail</span>
                    </label>
                    <input
                        name="email"
                        type="email"
                        class="input input-bordered w-full"
                        required
                        autofocus
                        value="{{ old('email') }}"
                    >
                </div>

                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Senha</span>
                    </label>
                    <input
                        name="password"
                        type="password"
                        class="input input-bordered w-full"
                        required
                    >
                    <label class="label">
                        <a href="#" class="label-text-alt link link-hover">
                            Esqueceu a senha?
                        </a>
                    </label>
                </div>

                <div class="form-control">
                    <label class="cursor-pointer label justify-start gap-2">
                        <input type="checkbox" name="remember" class="checkbox checkbox-primary">
                        <span class="label-text">Lembrar-me</span>
                    </label>

                    @error('message')
                    <div class="text-center">
                        <span class="text-error text-sm mt-1">
                            {{ $message }}
                        </span>
                    </div>
                    @enderror
                </div>

                <button class="btn btn-primary w-full mt-4">
                    Entrar
                </button>
            </form>

            <div class="divider">ou</div>

            <!-- Login com Google -->
            <a
                href="{{ route('google.redirect') }}"
                class="btn btn-outline w-full flex items-center gap-2"
            >
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="w-5 h-5">
                    <path fill="#EA4335" d="M24 9.5c3.15 0 5.93 1.08 8.14 2.85l6.1-6.1C34.51 2.43 29.64 0 24 0 14.6 0 6.55 5.38 2.62 13.22l7.1 5.52C11.61 13.03 17.33 9.5 24 9.5z"/>
                    <path fill="#4285F4" d="M46.1 24.5c0-1.56-.14-3.06-.39-4.5H24v9h12.4c-.53 2.87-2.13 5.3-4.53 6.94l7.02 5.47C43.63 37.07 46.1 31.3 46.1 24.5z"/>
                    <path fill="#FBBC05" d="M9.72 28.74c-.48-1.44-.76-2.97-.76-4.74s.28-3.3.76-4.74l-7.1-5.52C.9 17.1 0 20.45 0 24s.9 6.9 2.62 10.26l7.1-5.52z"/>
                    <path fill="#34A853" d="M24 48c6.48 0 11.93-2.14 15.9-5.8l-7.02-5.47c-1.95 1.31-4.44 2.08-8.88 2.08-6.67 0-12.39-3.53-14.28-8.74l-7.1 5.52C6.55 42.62 14.6 48 24 48z"/>
                </svg>
                Entrar com Google
            </a>

            <p class="text-center text-sm mt-4">
                Ainda não tem conta?
                <a href="{{ route('register') }}" class="link link-primary font-medium">
                    Criar conta
                </a>
            </p>

        </div>
    </div>
</x-layout>
