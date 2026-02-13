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

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

        <!-- Header -->
        <div class="space-y-2">
            <h1 class="text-3xl md:text-4xl font-bold">
                Editar Transação
            </h1>
            <p class="text-base-content/60">
                Atualize os dados da transação abaixo.
            </p>
        </div>

        <!-- Card -->
        <div class="card bg-base-100 shadow-xl border border-base-200">
            <div class="card-body p-6 md:p-8 space-y-6">

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
                            Selecione uma Categoria
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
                        @click="onUpdateTransaction(transaction_info.id)"
                        type="submit"
                        class="btn btn-primary w-full md:w-auto md:px-10 shadow-md hover:shadow-lg transition"
                        :class="{ 'loading': form.processing }"
                    >
                        Atualizar Transação
                    </button>
                </div>

            </div>
        </div>

    </div>

</AppLayout>
</template>
