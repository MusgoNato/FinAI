<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import CategoryFilter from '@/Components/CategoryFilter.vue';
import TypeFilter from '@/Components/TypeFilter.vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import { route } from 'ziggy-js';
import Pagination from '@/Components/Pagination.vue';
import { debounce } from 'lodash';
import DataFilter from '@/Components/DataFilter.vue';

const page = usePage();

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

const onDeleteTransaction = (id) => {
    if(confirm("Deseja realmente excluir esta transação?"))
    {
        router.delete(route('transactions.destroy', id), {
            preserveScroll: true,
            preserveState: false,
        });
    }
}

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

const currencyFormatter = new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL',
});

const formatCurrency = (value) =>
  currencyFormatter.format(value ?? 0);
  
</script>

<template>
<AppLayout>

    <!-- Toast -->
    <div v-if="SuccessMessage" class="toast toast-top toast-center z-50">
        <div class="alert alert-success shadow-xl">
            <span class="font-medium">{{ SuccessMessage }}</span>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold">
                    Todas as Transações
                </h1>
                <p class="text-base-content/60 mt-1">
                    Aqui você pode visualizar todas as despesas registradas.
                </p>
            </div>

            <Link 
                :href="route('transactions.create')"
                class="btn btn-primary shadow-md hover:shadow-lg transition"
            >
                Nova Transação
            </Link>
        </div>

        <!-- Filtros -->
        <div class="card bg-base-100 shadow-md border border-base-200">
            <div class="card-body space-y-6">

                <div class="flex flex-col lg:flex-row lg:items-center gap-4">

                    <!-- Categoria + Tipo + Limpar -->
                    <div class="flex flex-wrap gap-2">
                        <CategoryFilter v-model="filters.category" />
                        <TypeFilter v-model="filters.type" />

                        <button 
                            class="btn btn-sm btn-outline btn-primary"
                            @click="clearFilters"
                        >
                            Limpar Filtro
                        </button>
                    </div>

                    <!-- Busca -->
                    <div class="flex-1 lg:max-w-xs">
                        <input
                            v-model="filters.search"
                            type="text"
                            placeholder="Buscar descrição..."
                            class="input input-bordered input-sm w-full focus:input-primary"
                        >
                    </div>

                    <!-- Datas -->
                    <DataFilter 
                        v-model:start_date="filters.start_date"
                        v-model:end_date="filters.end_date"
                    />

                </div>

            </div>
        </div>

        <!-- Tabela -->
        <!-- DESKTOP TABLE -->
        <div class="hidden md:block overflow-x-auto rounded-lg">
        <table class="table table-zebra table-hover w-full">

            <thead>
            <tr class="text-base-content/70">
                <th>Descrição</th>
                <th>Categoria</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th>Data</th>
                <th class="text-center">Ações</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="transaction in transactions" :key="transaction.id">

                <td class="font-medium">
                {{ transaction.description }}
                </td>

                <td>
                <span class="badge badge-outline badge-sm">
                    {{ transaction.category }}
                </span>
                </td>

                <td>
                <span
                    :class="transaction.type === 'Receita'
                    ? 'text-success font-semibold'
                    : 'text-error font-semibold'"
                >
                    {{ transaction.type }}
                </span>
                </td>

                <td
                :class="transaction.type === 'Receita'
                    ? 'text-success font-semibold'
                    : 'text-error font-semibold'"
                >
                {{ transaction.type === 'Receita' ? '+' : '-' }}
                {{ formatCurrency(transaction.price) }}
                </td>

                <td class="text-base-content/60">
                {{ transaction.date_formatted }}
                </td>

                <td>
                <div class="flex justify-center gap-2">
                    <Link 
                    :href="route('transactions.edit', transaction.id)"
                    class="btn btn-xs btn-ghost"
                    >
                    Editar
                    </Link>

                    <button 
                    @click="onDeleteTransaction(transaction.id)"
                    class="btn btn-xs btn-error btn-outline"
                    >
                    Excluir
                    </button>
                </div>
                </td>

            </tr>
            </tbody>

        </table>
        </div>


        <!-- MOBILE CARDS -->
        <div class="md:hidden space-y-4">

        <div
            v-for="transaction in transactions"
            :key="transaction.id"
            class="card bg-base-200 shadow-md"
        >
            <div class="card-body p-4 space-y-3">

            <!-- Top -->
            <div class="flex justify-between items-start">
                <h3 class="font-semibold text-base">
                {{ transaction.description }}
                </h3>

                <div
                :class="[
                    'text-sm font-bold',
                    transaction.type === 'Receita'
                    ? 'text-success'
                    : 'text-error'
                ]"
                >
                {{ transaction.type === 'Receita' ? '+' : '-' }}
                {{ formatCurrency(transaction.price) }}
                </div>
            </div>

            <!-- Middle -->
            <div class="flex justify-between items-center text-sm text-base-content/70">

                <span class="badge badge-outline badge-xs">
                {{ transaction.category }}
                </span>

                <span>
                {{ transaction.date_formatted }}
                </span>

            </div>

            <!-- Tipo -->
            <div>
                <span
                :class="transaction.type === 'Receita'
                    ? 'text-success font-medium text-sm'
                    : 'text-error font-medium text-sm'"
                >
                {{ transaction.type }}
                </span>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-2 pt-2">
                <Link 
                :href="route('transactions.edit', transaction.id)"
                class="btn btn-xs btn-outline"
                >
                Editar
                </Link>

                <button 
                @click="onDeleteTransaction(transaction.id)"
                class="btn btn-xs btn-error btn-outline"
                >
                Excluir
                </button>
            </div>

            </div>
        </div>

        <div 
            v-if="transactions.length === 0" 
            class="text-center py-10 text-base-content/50"
        >
            Não há nenhuma transação registrada
        </div>

        </div>

        <div class="mt-4">
            <ul class="pagination flex gap-1 justify-end">

                <!-- Componente de paginação -->
                <Pagination :links="paginator.links"></Pagination>
            </ul>
        </div>


    </div>

</AppLayout>
</template>
