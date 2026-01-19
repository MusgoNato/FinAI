<x-layout title="Dashboard">
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
                                <tr>
                                    <td>Supermercado</td>
                                    <td>Alimentação</td>
                                    <td class="text-error">- R$ 230,00</td>
                                    <td>10/01/2026</td>
                                </tr>
                                <tr>
                                    <td>Salário</td>
                                    <td>Renda</td>
                                    <td class="text-success">+ R$ 5.000,00</td>
                                    <td>05/01/2026</td>
                                </tr>
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

                    <button class="btn btn-primary w-full">
                        Nova Receita
                    </button>

                    <button class="btn btn-error btn-outline w-full">
                        Nova Despesa
                    </button>

                    <button class="btn btn-secondary btn-outline w-full">
                        Relatórios
                    </button>
                </div>
            </div>

        </div>

    </div>

</x-layout>
