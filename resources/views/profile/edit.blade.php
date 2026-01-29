<x-layout title="Editar Perfil">

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
            <h1 class="text-3xl font-bold">Editar Perfil</h1>
            <a href="{{ route('profile.show') }}" class="btn btn-outline">Voltar</a>
        </div>

        <!-- Formulário -->
        <div class="card bg-base-100 shadow-lg p-6">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nome -->
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Nome</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input input-bordered w-full" required>
                    @error('name')
                        <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input input-bordered w-full" required>
                    @error('email')
                        <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Foto de Perfil (opcional) -->
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Foto de Perfil</span>
                    </label>
                    <input type="file" name="profile_image" class="file-input file-input-bordered w-full">
                    @error('profile_image')
                        <span class="text-error text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Botão -->
                <div class="flex justify-end gap-4">
                    <a href="{{ route('profile.show') }}" class="btn btn-outline">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                </div>

            </form>
        </div>

    </div>

</x-layout>
