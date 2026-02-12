
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CategoryFilter from '@/Components/CategoryFilter.vue';
import TypeFilter from '@/Components/TypeFilter.vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import { route } from 'ziggy-js';
import Pagination from '@/Components/Pagination.vue';
import { debounce, filter } from 'lodash';
import DataFilter from '@/Components/DataFilter.vue';

const page = usePage();

// Define os tipos das variaveis que virao
const props = defineProps({
    transactions: Object,
    filters: Object,
    category: Object,
});

const SuccessMessage = computed(
    () => page.props.flash.success
);



const paginator = computed(() => page.props.transactions);
const transactions = computed(() => paginator.value.data);

// Para deletes de transações
const onDeleteTransaction = (id) => {
    if(confirm("Deseja realmente excluir esta transação?"))
    {
        router.delete(route('transactions.destroy', id), {
            preserveScroll: true,
            preserveState: false,
        });
    }else{
        return;
    }
    
}

// Filtros (busca, tipos, categorias, datas, etc)
const filters = ref({
    search: page.props.filters?.search ?? '',
    type: page.props.filters?.type ?? '',
    category: page.props.filters?.category ?? '',
    start_date: page.props.filters?.start_Date ?? '',
    end_date: page.props.filters?.end_date ?? '',    
});


const clearFilters = () => {
    filters.value =  {
        search: '',
        type: '',
        category: '',
        start_date: '',
        end_date: '',
    }
    router.get('transactions.index', {}, {
        preserveScroll: true,
        preserveState: true,
        replace: true,
    })
}


// Aplica os filtros fazendo a requisição a pagina index das transações
const applyFilters = debounce(() => {
    router.get(
        route('transactions.index'),
        filters.value,
        {
            preserveScroll: true,
            preserveState: true,
            replace: true,
        }
    )
}, 400);

watch(
    filters, 
    () => {
        applyFilters()
    },
    {deep: true}
);

</script>

<template>
    <AppLayout>
        <div v-if="SuccessMessage" class="fixed top-18 left-1/2 transform -translate-x-1/2 z-50">
            <div class="alert alert-success shadow-lg flex items-center gap-2 w-96 fade-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current h-6 w-6" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ SuccessMessage }}</span>
            </div>
        </div>
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
                <div class="flex gap-2 flex-wrap py-4">
                    <CategoryFilter v-model="filters.category"></CategoryFilter>
                    <TypeFilter v-model="filters.type"></TypeFilter>


                    <button class="btn btn-sm btn-outline btn-primary gap-1"
                    @click="clearFilters">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 12.414V19a1 1 0 01-.447.832l-4 2.667A1 1 0 019 21v-8.586L3.293 6.707A1 1 0 013 6V4z" />
                        </svg>
                        Limpar Filtro
                    </button>
                </div>

                <!-- Campo de busca -->
                <div class="flex-1 sm:max-w-xs">
                    <input
                        v-model="filters.search"
                        type="text"
                        placeholder="Buscar descrição..."
                        class="input input-bordered input-sm w-full"
                    >
                </div>

                <!-- Datas -->
                <DataFilter 
                    v-model:start_date="filters.start_date"
                    v-model:end_date="filters.end_date"
                />

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

