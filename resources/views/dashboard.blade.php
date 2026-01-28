<x-layout title="Dashboard">
    <!-- Alert -->
    @if (session('success'))
        <div class="fixed top-18 left-1/2 transform -translate-x-1/2 z-50">
            <div class="alert alert-success shadow-lg flex items-center gap-2 w-96">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif


    <div class="w-full max-w-7xl px-4 py-6 space-y-6">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold">
                    Bem-vindo, {{ auth()->user()->name }}
                </h1>
            </div>
        </div>

        <!-- Cards resumo -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <!-- <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <p class="text-sm text-base-content/70">Saldo Atual</p>
                    <h2 class="text-2xl font-bold text-success">
                        R$ 5.420,00
                    </h2>
                </div>
            </div> -->

            <!-- <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <p class="text-sm text-base-content/70">Receitas</p>
                    <h2 class="text-2xl font-bold text-primary">
                    </h2>
                </div>
            </div> -->

            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <p class="text-sm text-base-content/70">Despesas</p>
                    <h2 class="text-2xl font-bold text-error">
                        R$ {{ number_format($total_by_category['Despesa'], 2, ',', '.') }}
                    </h2>
                </div>
            </div>

            <!-- <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <p class="text-sm text-base-content/70">Economia</p>
                    <h2 class="text-2xl font-bold text-warning">
                        R$ 1.150,00
                    </h2>
                </div>
            </div> -->

        </div>

        <!-- Seção principal -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Últimas transações -->
            <div class="lg:col-span-2 card bg-base-100 shadow">
                <div class="card-body">
                    <h2 class="card-title">
                        Últimas Transações
                    </h2>

                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Descrição</th>
                                    <th>Categoria</th>
                                    <th>Valor</th>
                                    <th>Data</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($last_transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction['description'] }}</td>
                                        <td>{{ $transaction['category'] }}</td>
                                        <td>{{ number_format($transaction['price'], 2, ',', '.') }}</td>
                                        <td>{{ $transaction['date']->format('m/d/Y') }}</td>
                                        <td>
                                            <a class="btn" href="{{ route('transactions.edit', $transaction->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                            <form 
                                                action="{{ route('transactions.destroy', $transaction->id) }}" 
                                                method="POST"
                                                onsubmit="return confirm('Tem certeza que deseja excluir?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center">Nenhuma transação realizada</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Ações rápidas -->
            <div class="card bg-base-100 shadow">
                <div class="card-body space-y-4">
                    <h2 class="card-title">
                        Ações Rápidas
                    </h2>
                    
                    <a class="btn btn-error btn-outline w-full" href="{{ route('transactions.create') }}">Nova Transação</a>
                    
                    <a class="btn btn-secondary btn-outline w-full" href="#">Relatórios</a>
                </div>
            </div>

        </div>

    </div>

</x-layout>
