<x-layout title="Criar Conta">
    <div class="card w-full max-w-md shadow-2xl bg-base-100">
        <div class="card-body gap-6">

            <!-- Cabeçalho -->
            <div class="text-center">
                <h1 class="text-3xl font-bold text-primary">
                    Crie uma conta
                </h1>
                <p class="text-sm text-base-content/70">
                    Comece a controlar suas finanças agora
                </p>
            </div>

            <!-- Formulário -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Nome -->
                <div @class(['form-control', 'text-error' => $errors->has('name')])>
                    <label class="label">
                        <span class="label-text">Nome</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        @class([
                            'input input-bordered w-full',
                            'input-error' => $errors->has('name')
                        ])
                        required
                        autofocus
                    >

                    @error('name')
                        <span class="text-error text-sm mt-1">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Email -->
                <div @class(['form-control', 'text-error' => $errors->has('email')])>
                    <label class="label">
                        <span class="label-text">E-mail</span>
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        @class([
                            'input input-bordered w-full',
                            'input-error' => $errors->has('email')
                        ])
                        required
                    >

                    @error('email')
                        <span class="text-error text-sm mt-1">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Senha -->
                <div @class(['form-control', 'text-error' => $errors->has('password')])>
                    <label class="label">
                        <span class="label-text">Senha</span>
                    </label>

                    <input
                        type="password"
                        name="password"
                        @class([
                            'input input-bordered w-full',
                            'input-error' => $errors->has('password')
                        ])
                        required
                    >

                    @error('password')
                        <span class="text-error text-sm mt-1">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Confirmação de senha -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Confirmar Senha</span>
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="input input-bordered w-full"
                        required
                    >
                </div>

                <button class="btn btn-primary w-full mt-2">
                    Criar Conta
                </button>
            </form>

            <div class="divider">ou</div>

            <p class="text-center text-sm">
                Já tem uma conta?
                <a href="{{ route('login') }}" class="link link-primary font-medium">
                    Entrar
                </a>
            </p>

        </div>
    </div>

</x-layout>
