<x-layout title="Nova Despesa">
    <div class="w-full max-w-3xl px-4 py-6 mx-auto">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-base-content">
                Editar Transação
            </h1>
            <p class="text-sm text-base-content/70 mt-1">
                Preencha os dados abaixo para registrar a transação.
            </p>
        </div>

        <!-- Formulário -->
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('transactions.update', $transaction_info->id) }}">
                    @csrf
                    @method('PUT')

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
                            value="{{ $transaction_info->description }}"
                            maxlength="80"
                        >
                        @error('description')
                            <span class="alert-error text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Categoria -->
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Selecione uma Categoria</span>
                        </label>
                        <x-category :selected="old('category', $transaction_info->category)" />
                        @error('category')
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
                            value="{{ $transaction_info->price }}"
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
                            value="{{ $transaction_info->date->format('Y-m-d') }}" 
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
                        <textarea name="notes" class="textarea textarea-bordered w-full" placeholder="Ex: Compras no supermercado semanal" aria-valuetext="{{ $transaction_info->notes }}"></textarea>
                        @error('notes')
                            <span class="alert-error text-error">{{ $message }}</span>
                        @enderror
                    </div>
                    

                    <!-- Botão de envio -->
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-error w-full">
                            Atualizar Despesa
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-layout>
