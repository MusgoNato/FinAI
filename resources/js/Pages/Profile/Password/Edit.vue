<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import { route } from 'ziggy-js';
const page = usePage()

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const hasLocalPassword = computed(
    () => page.props.hasLocalPassword
)

const SuccessMessage = computed(
    () => page.props.flash.success
)


const updatedPassword = () => {
    form.put(route('profile.update_password'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            router.reload({only: ['hasLocalPassword']})
        },
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
            }
            if (form.errors.current_password) {
                form.reset('current_password');
            }
        },
    });
}

</script>

<template>
    <div v-if="SuccessMessage" class="fixed top-18 left-1/2 transform -translate-x-1/2 z-50 fade-out">
        <div class="alert alert-success shadow-lg flex items-center gap-2 w-96 fade-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current h-6 w-6" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span>{{ SuccessMessage }}</span>
        </div>
    </div>

    <AppLayout>
        <div class="w-full max-w-4xl mx-auto px-4 py-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <h1 class="text-3xl font-bold">Alterar Senha</h1>
                <Link :href="route('profile.show')" class="btn btn-outline">Voltar</Link>
            </div>

            <div v-if="!hasLocalPassword">
                <div class="alert alert-info shadow-lg mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z"/></svg>
                    <span>Você fez login via Google e não possui senha local. Crie uma senha abaixo.</span>
                </div>

                <div class="card bg-base-100 shadow-lg p-6">
                    <form @submit.prevent="updatedPassword" class="space-y-6">
                        <div class="form-control w-full">
                            <label class="label"><span class="label-text">Nova Senha</span></label>
                            <input v-model="form.password" type="password" class="input input-bordered w-full" :class="{'input-error': form.errors.password}" required>
                            <span v-if="form.errors.password" class="text-error text-sm mt-1">{{ form.errors.password }}</span>
                        </div>
                        <div class="form-control w-full">
                            <label class="label"><span class="label-text">Confirme a Senha</span></label>
                            <input v-model="form.password_confirmation" type="password" class="input input-bordered w-full" required>
                        </div>
                        <div class="flex justify-end gap-4">
                            <button :disabled="form.processing" type="submit" class="btn btn-primary">
                                <span v-if="form.processing" class="loading loading-spinner"></span> Criar Senha
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div v-else>
                <div class="card bg-base-100 shadow-lg p-6">
                    <form @submit.prevent="updatedPassword" class="space-y-6">
                        
                        <div class="form-control w-full">
                            <label class="label"><span class="label-text">Senha Atual</span></label>
                            <input 
                                v-model="form.current_password" 
                                class="input input-bordered w-full" 
                                :class="{'input-error': form.errors.current_password}"
                                type="password" 
                                required
                            >
                            <span v-if="form.errors.current_password" class="text-error text-sm mt-1">{{ form.errors.current_password }}</span>
                        </div>

                        <div class="form-control w-full">
                            <label class="label"><span class="label-text">Nova Senha</span></label>
                            <input v-model="form.password" type="password" class="input input-bordered w-full" :class="{'input-error': form.errors.password}" required>
                            <span v-if="form.errors.password" class="text-error text-sm mt-1">{{ form.errors.password }}</span>
                        </div>

                        <div class="form-control w-full">
                            <label class="label"><span class="label-text">Confirmar Nova Senha</span></label>
                            <input v-model="form.password_confirmation" type="password" class="input input-bordered w-full" required>
                        </div>

                        <div class="flex justify-end gap-4">
                            <Link :href="route('profile.show')" class="btn btn-outline">Cancelar</Link>
                            <button :disabled="form.processing" type="submit" class="btn btn-primary">
                                <span v-if="form.processing" class="loading loading-spinner"></span> Alterar Senha
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
