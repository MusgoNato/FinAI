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

            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <p class="text-sm text-base-content/70">Saldo Atual</p>
                    <h2 class="text-2xl font-bold text-success">
                        R$ 5.420,00
                    </h2>
                </div>
            </div>

            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <p class="text-sm text-base-content/70">Receitas</p>
                    <h2 class="text-2xl font-bold text-primary">
                        R$ 8.200,00
                    </h2>
                </div>
            </div>

            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <p class="text-sm text-base-content/70">Despesas</p>
                    <h2 class="text-2xl font-bold text-error">
                        R$ 2.780,00
                    </h2>
                </div>
            </div>

            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <p class="text-sm text-base-content/70">Economia</p>
                    <h2 class="text-2xl font-bold text-warning">
                        R$ 1.150,00
                    </h2>
                </div>
            </div>

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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($last_transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction['description'] }}</td>
                                        <td>Categoria</td>
                                        <td>{{ $transaction['price'] }}</td>
                                        <td>{{ $transaction['date'] }}</td>
                                    </tr>
                                @endforeach
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
                    
                    <a class="btn btn-error btn-outline w-full" href="{{ route('transactions.create') }}">Nova Despesa</a>
                    
                    <a class="btn btn-secondary btn-outline w-full" href="#">Relatórios</a>
                </div>
            </div>

        </div>

    </div>

</x-layout>
