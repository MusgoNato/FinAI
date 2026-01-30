<x-layout title="Nova Despesa">
    <div class="w-full max-w-3xl px-4 py-6 mx-auto">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-base-content">
                Nova Transação
            </h1>
            <p class="text-sm text-base-content/70 mt-1">
                Preencha os dados abaixo para registrar uma nova transação.
            </p>
        </div>

        <!-- Formulário -->
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('transactions.store') }}">
                    @csrf

                    <!-- Descrição -->
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Descrição</span>
                        </label>
                        <input 
                            type="text" 
                            name="description" 
                            class="input input-bordered w-full" 
                            placeholder="Ex: Supermercado" 
                            required
                            value="{{ old('description') }}"
                            maxlength="80"
                        >
                        @error('description')
                            <span class="alert-error text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Categoria -->
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Selecione uma categoria</span>
                        </label>

                        <x-category />

                        @error('category')
                            <span class="alert-error text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tipo da transação -->
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Selecione o tipo da transação</span>
                        </label>

                        <x-type />

                        @error('type')
                            <span class="alert-error text-error">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Valor -->
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Valor</span>
                        </label>
                        <input 
                            type="number" 
                            name="price" 
                            class="input input-bordered w-full" 
                            step="0.01" 
                            placeholder="Ex: 150.00"
                            max="9999999"
                            value="{{ old('price') }}"
                            required
                        >
                        @error('price')
                            <span class="alert-error text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Data -->
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Data da Despesa</span>
                        </label>
                        <input 
                            type="date" 
                            name="date" 
                            class="input input-bordered w-full" 
                            value="{{ old('date') }}" 
                            required
                        >
                        @error('date')
                            <span class="alert-error text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Observações -->
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Observações (opcional)</span>
                        </label>
                        <textarea name="notes" class="textarea textarea-bordered w-full" placeholder="Ex: Compras no supermercado semanal" aria-valuetext="{{ old('notes') }}"></textarea>
                        @error('notes')
                            <span class="alert-error text-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Botão de envio -->
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-error w-full">
                            Registrar Transação
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</x-layout>
