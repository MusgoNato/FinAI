<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { reactive, ref } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { route } from 'ziggy-js'

const page = usePage()

const form = useForm({
  token: page.props.token || '',
  email: page.props.email || '',
  password: '',
  password_confirmation: ''
})

const errors = reactive({})
const status = ref('')


function submit(){
    form.post(route('password.update'));   
}
</script>


<template>
    <AppLayout>
    <div class="min-h-screen flex items-center justify-center bg-base-200">

        <div class="card w-full max-w-md shadow-xl bg-base-100">
        <div class="card-body">

            <h2 class="card-title justify-center text-2xl">Redefinir Senha 🔒</h2>
            <p class="text-center text-sm text-base-content/70 mb-4">
            Insira sua nova senha para continuar
            </p>

            <!-- Form -->
            <form @submit.prevent="submit">

            <!-- Token e Email escondidos -->
            <input type="hidden" v-model="form.token">
            <input type="hidden" v-model="form.email">

            <!-- Nova senha -->
            <div class="form-control mb-4">
                <label class="label">
                <span class="label-text">Nova senha</span>
                </label>
                <input
                type="password"
                v-model="form.password"
                placeholder="Digite a nova senha"
                class="input input-bordered w-full"
                required
                />
                <!-- <span v-if="errors.password" class="text-red-500 text-sm mt-1">
                {{ errors.password }}
                </span> -->
            </div>

            <!-- Confirmação de senha -->
            <div class="form-control mb-4">
                <label class="label">
                <span class="label-text">Confirmar senha</span>
                </label>
                <input
                type="password"
                v-model="form.password_confirmation"
                placeholder="Repita a senha"
                class="input input-bordered w-full"
                required
                />
            </div>

            <button type="submit" class="btn btn-primary w-full">
                Redefinir Senha
            </button>

            </form>

            <!-- Status e erros gerais -->
            <!-- <div v-if="status" class="alert alert-success mt-4">
            {{ status }}
            </div>

            <div v-if="generalError" class="alert alert-error mt-4">
            {{ generalError }}
            </div> -->

        </div>
        </div>
    </div>
    </AppLayout>
</template>

