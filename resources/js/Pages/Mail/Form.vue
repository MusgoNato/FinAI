<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

const page = usePage()

// Formulário de código de verificação
const form = useForm({
  code: '',
})

// Mensagens de sucesso/erro
// const successMessage = ref(page.props.flash.success || '')
// const errorMessage = ref(page.props.errors?.code || '')

// Função para enviar o código
function submitCode() {
  form.post(route('verification.verify'))
}

// Função para reenviar código
function resendCode() {
  form.post(route('verification.send'))
}
</script>

<template>
  <div class="min-h-screen bg-base-200 flex flex-col items-center">

    <main class="flex flex-1 items-center justify-center w-full px-4 mt-10">
      <div class="card w-full max-w-md bg-base-100 shadow-xl">
        <div class="card-body">

          <h2 class="card-title justify-center">
            Verifique seu e-mail 📧
          </h2>

          <p class="text-center text-sm text-base-content/70">
            Enviamos um código de verificação para:
            <br>
            <strong>{{ page.props.auth.user?.email }}</strong>
          </p>

          <form @submit.prevent="submitCode" class="space-y-4 mt-4">
            <input
              type="text"
              v-model="form.code"
              maxlength="6"
              inputmode="numeric"
              placeholder="000000"
              class="input input-bordered w-full text-center text-lg tracking-widest"
              required
              autofocus
            />

            <!-- <p v-if="errorMessage" class="text-error text-sm text-center">
              {{ errorMessage }}
            </p> -->

            <button type="submit" class="btn btn-primary w-full">
              Confirmar código
            </button>
          </form>

          <div class="divider"></div>

          <div class="text-center text-sm">
            Não recebeu o código?
            <button @click="resendCode" class="link link-primary">
              Reenviar
            </button>
          </div>

          <!-- <div v-if="successMessage" class="alert alert-success mt-4">
            <span>{{ successMessage }}</span>
          </div> -->

        </div>
      </div>
    </main>

  </div>
</template>
