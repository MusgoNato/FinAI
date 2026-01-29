<x-layout title="Perfil">

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

    <div class="w-full max-w-7xl px-4 py-6 space-y-6">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <h1 class="text-3xl font-bold">Meu Perfil</h1>
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Editar Perfil</a>
        </div>

        <!-- Grid principal -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Card de Informações -->
            <div class="card bg-base-100 shadow flex flex-col items-center p-6">
                <div class="avatar mb-4">
                    <div class="w-24 h-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                        <img src="{{ $user->profile_image_url }}" alt="Profile Image" width="150">
                    </div>
                </div>

                <h2 class="text-xl font-bold">{{ $user->name }}</h2>
                <p class="text-sm text-base-content/70">{{ $user->email }}</p>

                <div class="mt-4 w-full space-y-4">
                    <div class="flex justify-between">
                        <span class="font-medium">Usuário desde:</span>
                        <span class="font-normal">{{ $user->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Último login:</span>
                    </div>
                </div>
            </div>

            <!-- Card de Ações -->
            <div class="lg:col-span-2 card bg-base-100 shadow flex flex-col p-6 gap-4">
                <h2 class="text-xl font-bold mb-4">Ações</h2>

                <a href="{{ route('profile.edit') }}" class="btn btn-primary w-full">Editar Informações</a>
                <a href="{{ route('profile.password') }}" class="btn btn-secondary w-full">Alterar Senha</a>

                <form action="{{ route('profile.destroy') }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir sua conta?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error w-full">Excluir Conta</button>
                </form>
            </div>

        </div>

    </div>

</x-layout>
