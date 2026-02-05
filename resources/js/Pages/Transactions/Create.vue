<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import Category from '@/Components/Category.vue';
import Type from '@/Components/Type.vue';

const page = usePage()

const errors = page.props.errors

const form = useForm({
    description: '',
    category: page.props.old?.category ?? '',
    type: page.props.old?.type ?? '',
    price: '',
    date: '',
    notes: '',
})

const onCreateNewTransaction = () => {
    form.post(route('transactions.store'))
}

</script>


<template>
    
    <AppLayout>
        <div class="w-full max-w-3xl px-4 py-6 mx-auto">

            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-base-content">
                    Nova Transação
                </h1>
                <p class="text-sm text-base-content/70 mt-1">
                    Preencha os dados abaixo para registrar uma nova transação.
                </p>
            </div>

            <!-- Formulário -->
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <form @submit.prevent="onCreateNewTransaction">

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
                            <span class="alert-error text-error">{{ errors.text }}</span>
                        </div>
                        
                        <!-- Categoria -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Selecione uma categoria</span>
                            </label>
                            
                            <!-- Componente Category.vue -->
                            <Category v-model="form.category"></Category>

                            <span class="alert-error text-error">{{ errors.category }}</span>
                        </div>

                        <!-- Tipo da transação -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text">Selecione o tipo da transação</span>
                            </label>
                            
                            <!-- Componente Type.vue -->
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
                            <span class="alert-error text-error">{{ errors.message }}</span>
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
                                value="{{ old('date') }}" 
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
                            placeholder="Ex: Compras no supermercado semanal" 
                            ></textarea>
                            <span class="alert-error text-error">{{ errors.notes }}</span>
                        </div>

                        <!-- Botão de envio -->
                        <div class="form-control mt-6">
                            <button type="submit" class="btn btn-error w-full">
                                Registrar Transação
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>

    </AppLayout>
</template>