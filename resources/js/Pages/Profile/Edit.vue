<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed, onMounted } from 'vue';
import { route } from 'ziggy-js';

const page = usePage()

const errors = computed(() => page.props.errors)

const user = computed(() => page.props.auth.user)


const SuccessMessage = computed(
    () => page.props.flash.success
)


const form = useForm({
    _method: 'PUT',
    name: user.value?.name ?? '',
    email: user.value?.email ?? '',
    profile_image: null,
})

// Atualização da foto de perfil
const handleFileChange = (e) => {
    form.profile_image = e.target.files[0]
}

// Envio das info para o controller no BackEnd (Deve ser POST com o tipo do metodo sendo PUT no useForm, para que o Laravel
// consiga decodificar e chegar de forma correta no UserProfileController, caso não seja desse modo ele não enviara os campos corretamente)
// No caso se trocar para post abaixo ele da erro de rota com metodo diferente Vue(POST) -> Laravel(PUT). O forceFormData transforma tudo em 
// DataForm, que le arquivos de forma correta, mas os outros campos não são lidos corretamente, mesmo populados o Laravel não consegue ler e rejeita-os
// Assim sendo, a melhor forma é enviar via POST e adicionar o _method PUT no useForm, pois ao enviar o formulario este tera o metodo PUT e o Laravel conseguirá decodificar 
// tanto os campos name, email e o profile_image.
const UpdateInfoProfile = () => {
    form.post(route('profile.update'), {
        preserveScroll: true,        
        forceFormData: true,
    });
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

        <div class="w-full max-w-4xl mx-auto px-4 py-6">

            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <h1 class="text-3xl font-bold">Editar Perfil</h1>
                <Link :href="route('profile.show')" class="btn btn-outline">Voltar</Link>
            </div>

            <!-- Formulário -->
            <div class="card bg-base-100 shadow-lg p-6">
                <form @submit.prevent="UpdateInfoProfile" enctype="multipart/form-data" class="space-y-6">

                    <!-- Nome -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Nome</span>
                        </label>
                        <input v-model="form.name" type="text" name="name" class="input input-bordered w-full" required> 
                        <span class="text-error text-sm mt-1">{{ errors.name }}</span>
                    </div>

                    <!-- Email -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input v-model="form.email" type="email" name="email" class="input input-bordered w-full" required>
                            <span class="text-error text-sm mt-1">{{ errors.email }}</span>
                    </div>

                    <!-- Foto de Perfil (opcional) -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Foto de Perfil</span>
                        </label>
                        <input type="file" accept="image/*" name="profile_image" class="file-input file-input-bordered w-full" @change="handleFileChange">
                        <span class="text-error text-sm mt-1">{{ errors.profile_image }}</span>
                    </div>

                    <!-- Botão -->
                    <div class="flex justify-end gap-4">
                        <Link :href="route('profile.show')" class="btn btn-outline">Cancelar</Link>
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                    </div>

                </form>
            </div>

        </div>
    </AppLayout>

</template>