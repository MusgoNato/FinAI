<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { route } from 'ziggy-js';

const page = usePage()
const user = page.props.auth.user

const form = useForm({})

const SuccessMessage = computed(
    () => page.props.flash.success 
) 

const handleDelete = () => {
    if(confirm('Tem certeza que deseja excluir sua conta?')){
        form.delete(route('profile.destroy'), {
            onBefore: () => confirm('Esta ação não pode ser desfeita. Continuar?'),
            onFinish: () => form.reset,
        });
    }
}

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

        <div class="w-full max-w-7xl px-4 py-6 space-y-6">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <h1 class="text-3xl font-bold">Meu Perfil</h1>
                <Link :href="route('profile.edit')" class="btn btn-primary">Editar Perfil</Link>
            </div>

            <!-- Grid principal -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Card de Informações -->
                <div class="card bg-base-100 shadow flex flex-col items-center p-6">
                    <div class="avatar mb-4">
                        <div class="w-24 h-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                            <img :src="user.profile_image_url" alt="Profile Image" width="150">
                        </div>
                    </div>

                    <h2 class="text-xl font-bold">{{ user.name }}</h2>
                    <p class="text-sm text-base-content/70">{{ user.email }}</p>

                    <div class="mt-4 w-full space-y-4">
                        <div class="flex justify-between">
                            <span class="font-medium">Usuário desde:</span>
                            <span class="font-normal">{{ user.created_at_formatted }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-medium">Último login:</span>
                        </div>
                    </div>
                </div>

                <!-- Card de Ações -->
                <div class="lg:col-span-2 card bg-base-100 shadow flex flex-col p-6 gap-4">
                    <h2 class="text-xl font-bold mb-4">Ações</h2>

                    <Link :href="route('profile.edit')" class="btn btn-primary w-full">Editar Informações</Link>
                    
                    <Link :href="route('profile.password')" class="btn btn-secondary w-full">Alterar Senha</Link>

                    <button 
                    type="submit"
                    @click="handleDelete"
                    :disabled="form.processing"
                    class="btn btn-error w-full"
                    >{{ form.processing ? 'Excluindo...' : 'Excluir Conta' }}</button>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
