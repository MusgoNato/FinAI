<script setup>
import { ref } from 'vue';
import { router, useForm, usePage } from '@inertiajs/vue3';

import AppLayout from '@/Layouts/AppLayout.vue';
import CategoryFilter from '@/Components/CategoryFilter.vue';
import TypeFilter from '@/Components/TypeFilter.vue';
import { route } from 'ziggy-js';
import Alert from '@/Components/Alert.vue';
import { computed } from 'vue';

const showAdvanced = ref(false);
const loading = ref(false);
const page = usePage();

const form = useForm({
    start_date: '',
    end_date: '',
    category: null,
    document_type: 'pdf',
    type: '',
    account_id: null,
    min_amount: '',
    max_amount: '',
    status: '',
    sort_by: 'date_desc',
    group_by: '',
});

const flashSuccess = computed(() => page.props.flash?.success);

const submit = () => {
    window.location.href = route('reports.download', form.data());
}

const toggleAdvanced = () => {
    showAdvanced.value = !showAdvanced.value;

    // Se estiver ocultando, limpa os campos
    if (!showAdvanced.value) {
        form.min_amount = '';
        form.max_amount = '';
        form.sort_by = 'date_desc';
        form.group_by = '';
        form.account_id = null;
        form.status = '';
    }
};


</script>

<template>
<AppLayout>
    <Alert 
    v-if="flashSuccess"
    :message="flashSuccess"
    type="success"
    />

    <div class="max-w-4xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">
            Geração de Relatório Financeiro
        </h1>

        <form @submit.prevent="submit" class="space-y-6 bg-white p-6 rounded-lg shadow">
              
            <label class="block text-sm font-medium mb-1">
                Escolha o tipo de documento
            </label>
            <select class="select" name="document_type" required v-model="form.document_type">
                <option value="pdf">PDF</option>
                <option value="excel">Excel</option>
                <option value="csv">CSV</option>
            </select>

            <!-- Período -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">
                        Data inicial
                    </label>
                    <input
                        name="start_date"
                        required
                        v-model="form.start_date"
                        type="date"
                        :class="[
                            'w-full border rounded px-3 py-2',
                            form.errors.start_date ? 'border-red-500' : 'border-gray-300'
                        ]"
                    />

                    <span v-if="form.errors.start_date" class="text-error-content">{{ form.errors.start_date }}</span>
                </div>
                

                <div>
                    <label class="block text-sm font-medium mb-1">
                        Data final
                    </label>
                    <input
                        name="end_date"
                        required 
                        v-model="form.end_date"
                        type="date"
                        :class="[
                            'w-full border rounded px-3 py-2',
                            form.errors.end_date ? 'border-red-500' : 'border-gray-300'
                        ]">

                    <span v-if="form.errors.end_date" class="text-error-content">{{ form.errors.end_date }}</span>
                </div>
            </div>

            <!-- Tipo -->
            <div>
                <label class="block text-sm font-medium mb-1">
                    Tipo de transação
                </label>
                <TypeFilter name="type" v-model="form.type" :class="[
                    'w-full border rounded px-3 py-2',
                    form.errors.type ? 'border-red-500' : 'border-gray-300'
                ]"></TypeFilter>

                <span v-if="form.errors.type" class="text-error-content">{{ form.errors.type }}</span>

            </div>

            <!-- Categoria -->
            <div>
                <label class="block text-sm font-medium mb-1">
                    Categoria
                </label>
                <CategoryFilter name="category" v-model="form.category" />
                <span v-if="form.errors.category" class="text-error-content">{{ form.errors.category }}</span>

            </div>

            <!-- Filtros Avançados Toggle -->
            <div>
                <button type="button"
                        @click="toggleAdvanced"
                        class="text-indigo-600 text-sm font-medium">
                    {{ showAdvanced ? 'Ocultar filtros avançados' : 'Mostrar filtros avançados' }}
                </button>
            </div>

            <!-- Filtros Avançados -->
            <div v-if="showAdvanced"
                 class="space-y-6 border-t pt-6">

                <!-- Valor mínimo / máximo -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm mb-1">
                            Valor mínimo
                        </label>
                        <input 
                            name="min_amount"
                            type="number"
                            v-model="form.min_amount"
                            :class="[
                            'w-full border rounded px-3 py-2',
                            form.errors.min_amount ? 'border-red-500' : 'border-gray-300']"
                            placeholder="0.00">
                    </div>
                    <span v-if="form.errors.min_amount" class="text-error-content">{{ form.errors.min_amount }}</span>

                    <div>
                        <label class="block text-sm mb-1">
                            Valor máximo
                        </label>
                        <input
                            name="max_amount"
                            type="number"
                            v-model="form.max_amount"
                            class="w-full border rounded px-3 py-2"
                            placeholder="0.00">
                    </div>
                    <span v-if="form.errors.max_amount" class="text-error-content">{{ form.errors.max_amount }}</span>

                </div>

                <!-- Ordenação -->
                <div>
                    <label class="block text-sm mb-1">
                        Ordenar por
                    </label>
                    <select 
                            name="sort_by"
                            v-model="form.sort_by"
                            class="w-full border rounded px-3 py-2"
                            >
                        <option value="date_desc">Mais recentes</option>
                        <option value="date_asc">Mais antigas</option>
                        <option value="amount_desc">Maior valor</option>
                        <option value="amount_asc">Menor valor</option>
                    </select>

                    <span v-if="form.errors.sort_by" class="text-error-content">{{ form.errors.sort_by }}</span>

                </div>

                <!-- Agrupamento -->
                <div>
                    <label class="block text-sm mb-1">
                        Agrupar por
                    </label>
                    <select 
                        name="group_by"
                        v-model="form.group_by"
                        class="w-full border rounded px-3 py-2">
                        <option value="">Sem agrupamento</option>
                        <option value="month">Mês</option>
                        <option value="category">Categoria</option>
                        <option value="account">Conta</option>
                    </select>

                    <span v-if="form.errors.group_by" class="text-error-content">{{ form.errors.group_by }}</span>

                </div>

            </div>

            <!-- Botão -->
            <div>
                <button type="submit"
                        :disabled="loading"
                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 disabled:opacity-50">
                    <span v-if="!loading">
                        Gerar Relatório
                    </span>
                    <span v-else>
                        Gerando...
                    </span>
                </button>
            </div>

        </form>

    </div>
</AppLayout>
</template>
