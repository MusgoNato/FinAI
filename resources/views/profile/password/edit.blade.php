<x-layout title="Alterar Senha">

    <!-- Alert de sucesso -->
        @if (session('success'))
            <div class="fixed top-18 left-1/2 transform -translate-x-1/2 z-50">
                <div class="alert alert-success shadow-lg flex items-center gap-2 w-96 fade-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

    <div class="w-full max-w-4xl mx-auto px-4 py-6">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <h1 class="text-3xl font-bold">Alterar Senha</h1>
            <a href="{{ route('profile.show') }}" class="btn btn-outline">Voltar</a>
        </div>

        @if (!auth()->user()->password)
            <!-- Usuário sem senha local (login Google) -->
            <div class="alert alert-info shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z"/>
                </svg>
                <span>Você fez login via Google e não possui senha local. Crie uma senha para poder acessar também sem o Google.</span>
            </div>
            <!-- Formulário para criação de nova senha em caso de login com serviços externos -->
            <div class="card bg-base-100 shadow-lg p-6">
                <form action="{{ route('profile.update_password') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <!-- Senha para a aplicação -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Informe uma Senha</span>
                        </label>
                        <input type="password" name="password" class="input input-bordered w-full" required>
                        @error('password')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirmar nova senha -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Confirme a Senha</span>
                        </label>
                        <input type="password" name="password_confirmation" class="input input-bordered w-full" required>
                    </div>

                    <!-- Botão -->
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('profile.show') }}" class="btn btn-outline">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Alterar Senha</button>
                    </div>
                </form>
            </div>
        @else
            <!-- Formulário para alteração de senha -->
            <div class="card bg-base-100 shadow-lg p-6">
                <form action="{{ route('profile.update_password') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Senha atual -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Senha Atual</span>
                        </label>
                        @if(auth()->user()->password)
                            <!-- Campo senha atual -->
                            <input class="input input-bordered w-full" required type="password" name="current_password">
                            @error('current_password')
                                <span class="text-error text-sm mt-1">{{ $message }}</span>
                            @enderror
                        @endif
                    </div>

                    <!-- Nova senha -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Nova Senha</span>
                        </label>
                        <input type="password" name="password" class="input input-bordered w-full" required>
                        @error('password')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirmar nova senha -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Confirmar Nova Senha</span>
                        </label>
                        <input type="password" name="password_confirmation" class="input input-bordered w-full" required>
                        @error('password_confirmation')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Botão -->
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('profile.show') }}" class="btn btn-outline">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Alterar Senha</button>
                    </div>
                </form>
            </div>
        @endif

    </div>

</x-layout>
