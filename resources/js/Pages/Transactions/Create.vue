<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import Category from '@/Components/Category.vue';
import Type from '@/Components/Type.vue';

const page = usePage();
const errors = page.props.errors;

const form = useForm({
    description: '',
    category: page.props.old?.category ?? '',
    type: page.props.old?.type ?? '',
    price: '',
    date: '',
    notes: '',
});

const onCreateNewTransaction = () => {
    form.post(route('transactions.store'))
};
</script>

<template>
<AppLayout>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

        <!-- Header -->
        <div class="space-y-2">
            <h1 class="text-3xl md:text-4xl font-bold">
                Nova Transação
            </h1>
            <p class="text-base-content/60">
                Preencha os dados abaixo para registrar uma nova transação.
            </p>
        </div>

        <!-- Form Card -->
        <div class="card bg-base-100 shadow-xl border border-base-200">
            <div class="card-body p-6 md:p-8">

                <form @submit.prevent="onCreateNewTransaction" class="space-y-6">

                    <!-- Descrição -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Descrição</span>
                        </label>
                        <input 
                            v-model="form.description"
                            type="text" 
                            name="description" 
                            class="input input-bordered w-full focus:input-primary transition"
                            placeholder="Ex: Supermercado" 
                            required
                            maxlength="80"
                        >
                        <span v-if="errors.description" class="text-error text-sm mt-1">
                            {{ errors.description }}
                        </span>
                    </div>
                        
                    <!-- Categoria -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">
                                Selecione uma categoria
                            </span>
                        </label>
                        
                        <Category v-model="form.category" />

                        <span v-if="errors.category" class="text-error text-sm mt-1">
                            {{ errors.category }}
                        </span>
                    </div>

                    <!-- Tipo -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">
                                Selecione o tipo da transação
                            </span>
                        </label>
                        
                        <Type v-model="form.type" />

                        <span v-if="errors.type" class="text-error text-sm mt-1">
                            {{ errors.type }}
                        </span>
                    </div>

                    <!-- Valor -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Valor</span>
                        </label>
                        <input 
                            v-model="form.price"
                            type="number" 
                            name="price" 
                            class="input input-bordered w-full focus:input-primary transition"
                            step="0.01" 
                            placeholder="Ex: 150.00"
                            max="9999999"
                            required
                        >
                        <span v-if="errors.price" class="text-error text-sm mt-1">
                            {{ errors.price }}
                        </span>
                    </div>

                    <!-- Data -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">
                                Data da Transação
                            </span>
                        </label>
                        <input 
                            v-model="form.date"
                            type="date" 
                            name="date" 
                            class="input input-bordered w-full focus:input-primary transition"
                            required
                        >
                        <span v-if="errors.date" class="text-error text-sm mt-1">
                            {{ errors.date }}
                        </span>
                    </div>

                    <!-- Observações -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">
                                Observações (opcional)
                            </span>
                        </label>
                        <textarea 
                            v-model="form.notes"
                            name="notes" 
                            class="textarea textarea-bordered w-full focus:textarea-primary transition"
                            placeholder="Ex: Compras no supermercado semanal"
                            rows="4"
                        ></textarea>
                        <span v-if="errors.notes" class="text-error text-sm mt-1">
                            {{ errors.notes }}
                        </span>
                    </div>

                    <!-- Botão -->
                    <div class="pt-4">
                        <button 
                            type="submit" 
                            class="btn btn-primary w-full md:w-auto md:px-10 shadow-md hover:shadow-lg transition"
                            :class="{ 'loading': form.processing }"
                        >
                            Registrar Transação
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</AppLayout>
</template>
