<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import Type from '@/Components/Type.vue';
import Category from '@/Components/Category.vue';
import { computed } from 'vue';
import { route } from 'ziggy-js';

const page = usePage();

const errors = computed(() => page.props.errors);

const transaction_info = page.props.transaction_info;

const form = useForm({
    description: transaction_info.description ?? '',
    category: transaction_info.category ?? '',
    type: transaction_info.type ?? '',
    price: transaction_info.price ?? '',
    date: transaction_info.date_formatted ?? '',
    notes: transaction_info.notes ?? '',
});

const onUpdateTransaction = (id) => {
    form.post(route('transactions.store', id), {
        preserveScroll: true,
        _method: 'PUT',
    })
};

</script>

<template>
    <AppLayout>
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
                        <!-- Descrição -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Descrição</span>
                            </label>
                            <input 
                                v-model="form.description"
                                type="text" 
                                name="description" 
                                class="input input-bordered w-full" 
                                placeholder="Ex: Supermercado" 
                                required
                                maxlength="80"
                            >
                            <span class="alert-error text-error">{{ errors.description }}</span>
                        </div>
                        
                        <!-- Categoria -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Selecione uma Categoria</span>
                            </label>
                            <!-- Componente categorias -->
                            <Category v-model="form.category"></Category>
                            <span class="alert-error text-error">{{ errors.category }}</span>
                        </div>

                        <!-- Tipo da transação -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Selecione o tipo da transação</span>
                            </label>
                            
                            <!-- Componente tipos de transação -->
                            <Type v-model="form.type"></Type>

                            <span class="alert-error text-error">{{ errors.type }}</span>
                        </div>

                        <!-- Valor -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Valor</span>
                            </label>
                            <input 
                                v-model="form.price"
                                type="number" 
                                name="price" 
                                class="input input-bordered w-full" 
                                step="0.01" 
                                placeholder="Ex: 150.00"
                                max="9999999"
                                required
                            >
                            <span class="alert-error text-error">{{ errors.price }}</span>
                        </div>

                        <!-- Data -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Data da Despesa</span>
                            </label>
                            <input 
                                v-model="form.date"
                                type="date" 
                                name="date" 
                                class="input input-bordered w-full" 
                                required
                            >
                            <span class="alert-error text-error">{{ errors.date }}</span>
                        </div>

                        <!-- Observações -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Observações (opcional)</span>
                            </label>
                            <textarea 
                            v-model="form.notes"
                            name="notes"
                            class="textarea textarea-bordered w-full" 
                            placeholder="Ex: Compras no supermercado semanal"></textarea>
                            <span class="alert-error text-error">{{ errors.notes }}</span>
                        </div>
                        

                        <!-- Botão de envio -->
                        <div class="form-control mt-6">
                            <button 
                            @click="onUpdateTransaction(transaction_info.id)"
                            type="submit" class="btn btn-error w-full">
                                Atualizar Transação
                            </button>
                        </div>
                </div>
            </div>

        </div>

    </AppLayout>

</template>