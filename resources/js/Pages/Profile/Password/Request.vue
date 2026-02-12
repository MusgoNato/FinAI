<!-- resources/js/Pages/Auth/ForgotPassword.vue -->
<template>
    <AppLayout>
    <div class="min-h-screen flex items-center justify-center bg-base-200">

        <div class="w-full max-w-md p-8 bg-base-100 shadow-xl rounded-xl">

        <h1 class="text-2xl font-bold text-center mb-2">
            Esqueceu sua senha?
        </h1>

        <p class="text-sm text-center text-base-content/70 mb-6">
            Informe seu e-mail e enviaremos um link para redefinir sua senha.
        </p>

        <!-- Status -->
        <div v-if="status" class="alert alert-success mb-4 text-sm">
            {{ status }}
        </div>

        <!-- Form -->
        <form @submit.prevent="submit" class="space-y-4">
            <div class="form-control">
            <label class="label">
                <span class="label-text">E-mail</span>
            </label>

            <input
                type="email"
                v-model="form.email"    
                required
                autofocus
                placeholder="seu@email.com"
                :class="['input input-bordered w-full', errors.email ? 'input-error' : '']"
            />

            <span v-if="errors.email" class="text-error text-sm mt-1">
                {{ errors.email }}
            </span>
            </div>

            <button type="submit" class="btn btn-primary w-full">
            Enviar link de redefinição
            </button>
        </form>

        <div class="divider"></div>

        <div class="text-center">
            <Link :href="route('login')">Voltar para o Login</Link>
        </div>

        </div>
    </div>
</AppLayout>
</template>

<script setup>
import { reactive, ref } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

const form = useForm({
  email: ''
})

const errors = reactive({})
const status = ref('')

function submit() {
  form.post(route('password.email'))
}


</script>
