
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import { route } from 'ziggy-js';
import Pagination from '@/Components/Pagination.vue';

const page = usePage();

const paginator = computed(() => page.props.transactions);
const transactions = computed(() => paginator.value.data);

const onDeleteTransaction = (id) => {
    router.delete(route('transactions.destroy', id), {
        preserveScroll: true,
        preserveState: false,
    });
}

// TODO: DESENVOLVER PAGINAÇÃO (APOS ISSO FAZER A INTEGRAÇÃO COM O LARAVEL SCOUT + MELISEARCH)

</script>

<template>
    <AppLayout>
        <div class="w-full max-w-7xl px-4 py-6">
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
                    <Link 
                    :href="route('transactions.create')"
                    class="btn btn-error btn-outline">
                        Nova Transação
                    </Link>
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
                                <tr v-for="transaction in transactions" :key="transaction.id">
                                    <td>{{ transaction.description }}</td>
                                    <td>{{ transaction.category }}</td>
                                    <td>
                                        <span class="text-error font-medium">{{ transaction['type'] }}</span>
                                    </td>
                                    <td :class="transaction['type'] === 'Receita' ? 'text-success' : 'text-error'">
                                        {{ transaction['type'] === 'Receita' ? '+' : '-' }} 
                                        R$ {{ transaction.price}}
                                    </td>
                                    <td>{{ transaction.date_formatted}}</td>
                                    <td class="flex gap-2">
                                        <Link 
                                        :href="route('transactions.edit', transaction.id)"
                                        class="btn btn-sm btn-ghost">
                                            Editar
                                        </Link>
                                        <button 
                                        @click="onDeleteTransaction(transaction.id)"
                                        class="btn btn-sm btn-error">
                                            Excluir
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                            <div v-if="transactions.length === 0" class="alert justify-center">Não há nenhuma transação registrada</div>
                    </div>

                    <div class="mt-4">
                        <ul class="pagination flex gap-1 justify-end">

                            <!-- Componente de paginação -->
                            <Pagination :links="paginator.links"></Pagination>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </AppLayout>
</template>

