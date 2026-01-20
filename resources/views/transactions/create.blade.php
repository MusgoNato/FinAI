<x-layout title="Nova Despesa">
    <div class="w-full max-w-3xl px-4 py-6 mx-auto">

        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-base-content">
                Nova Despesa
            </h1>
            <p class="text-sm text-base-content/70 mt-1">
                Preencha os dados abaixo para registrar uma nova despesa.
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
                        >
                    </div>

                    <!-- Categoria -->
                    <div class="form-control mb-4">
                        <label class="label">
                            <!-- TODO: Fazer a categoria como componente separado -->
                            <span class="label-text">Categoria</span>
                        </label>
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
                            required
                        >
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
                            value="{{ date('Y-m-d') }}" 
                            required
                        >
                    </div>

                    <!-- Observações -->
                    <div class="form-control mb-4">
                        <label class="label">
                            <span class="label-text">Observações (opcional)</span>
                        </label>
                        <textarea 
                            name="notes" 
                            class="textarea textarea-bordered w-full" 
                            placeholder="Ex: Compras no supermercado semanal"
                        ></textarea>
                    </div>

                    <!-- Botão de envio -->
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-error w-full">
                            Registrar Despesa
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</x-layout>
