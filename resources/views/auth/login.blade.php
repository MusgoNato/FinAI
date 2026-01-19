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
                        name="email"
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
                        name="password"
                        class="input input-bordered w-full"
                        required
                        value="{{ old('password') }}"
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
                </div>

                <button class="btn btn-primary w-full mt-4">
                    Entrar
                </button>
            </form>

            <div class="divider">ou</div>

            <p class="text-center text-sm">
                Ainda não tem conta?
                <a href="{{ route('register') }}" class="link link-primary font-medium">
                    Criar conta
                </a>
            </p>

        </div>
    </div>
</x-layout>
