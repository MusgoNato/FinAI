<x-layout title="Transações">
    <div class="w-full max-w-7xl px-4 py-6 space-y-6">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold">
                    Todas as Transações
                </h1>
                <p class="text-sm text-base-content/70 mt-1">
                    Aqui você pode visualizar todas as despesas registradas.
                </p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('transactions.create') }}" class="btn btn-error btn-outline">
                    Nova Despesa
                </a>
            </div>
        </div>

        <!-- Filtro rápido + Busca -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <!-- Categoria e tipo -->
            <div class="flex gap-2 flex-wrap">
                <select class="select select-bordered select-sm">
                    <option disabled selected>Filtrar por categoria</option>
                    <option>Alimentação</option>
                    <option>Renda</option>
                    <option>Transporte</option>
                    <option>Lazer</option>
                </select>

                <select class="select select-bordered select-sm">
                    <option disabled selected>Filtrar por tipo</option>
                    <option>Despesa</option>
                </select>
            </div>

            <!-- Campo de busca -->
            <div class="flex-1 sm:max-w-xs">
                <input
                    type="text"
                    placeholder="Buscar descrição..."
                    class="input input-bordered input-sm w-full"
                >
            </div>

            <!-- Datas -->
            <div class="flex gap-2 flex-wrap">
                <input type="date" class="input input-bordered input-sm">
                <input type="date" class="input input-bordered input-sm">
            </div>
        </div>

        <!-- Tabela de transações -->
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <div class="overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Descrição</th>
                                <th>Categoria</th>
                                <th>Tipo</th>
                                <th>Valor</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $sampleTransactions = [
                                    ['description'=>'Supermercado', 'category'=>'Alimentação', 'type'=>'expense', 'price'=>230, 'date'=>'10/01/2026'],
                                    ['description'=>'Salário', 'category'=>'Renda', 'type'=>'income', 'price'=>5000, 'date'=>'05/01/2026'],
                                    ['description'=>'Uber', 'category'=>'Transporte', 'type'=>'expense', 'price'=>45, 'date'=>'12/01/2026'],
                                    ['description'=>'Freelance', 'category'=>'Renda', 'type'=>'income', 'price'=>1200, 'date'=>'15/01/2026'],
                                    ['description'=>'Cinema', 'category'=>'Lazer', 'type'=>'expense', 'price'=>60, 'date'=>'18/01/2026'],
                                ];
                            @endphp

                            @foreach ($sampleTransactions as $transaction)
                                <tr>
                                    <td>{{ $transaction['description'] }}</td>
                                    <td>{{ $transaction['category'] }}</td>
                                    <td>
                                        <span class="text-error font-medium">Despesa</span>
                                    </td>
                                    <td class="{{ $transaction['type'] === 'income' ? 'text-success' : 'text-error' }}">
                                        {{ $transaction['type'] === 'income' ? '+' : '-' }} 
                                        R$ {{ number_format($transaction['price'], 2, ',', '.') }}
                                    </td>
                                    <td>{{ $transaction['date'] }}</td>
                                    <td class="flex gap-2">
                                        <a href="#" class="btn btn-sm btn-ghost">
                                            Editar
                                        </a>
                                        <form method="POST" action="#">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-error">
                                                Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <!-- Paginação fictícia -->
                <div class="mt-4">
                    <ul class="pagination flex gap-1 justify-center">
                        <li><a class="btn btn-sm">1</a></li>
                        <li><a class="btn btn-sm btn-active">2</a></li>
                        <li><a class="btn btn-sm">3</a></li>
                        <li><a class="btn btn-sm">4</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</x-layout>
