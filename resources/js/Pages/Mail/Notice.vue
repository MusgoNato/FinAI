<template>
  <div class="min-h-screen bg-base-200 flex flex-col items-center">

    <main class="flex flex-1 items-center justify-center w-full px-4 mt-10">
      <div class="card w-full max-w-md bg-base-100 shadow-xl">
        <div class="card-body text-center space-y-4">

          <h2 class="card-title justify-center">Verificação de E-mail 📧</h2>

          <p class="text-base-content/70">
            Enviaremos um código de verificação para o e-mail:
          </p>

          <p class="font-semibold">{{ page.props.auth.user?.email }}</p>

          <button @click="sendCode" class="btn btn-primary w-full">
            Enviar código
          </button>

          <!-- Mensagem de sucesso -->
          <!-- <div v-if="successMessage" class="alert alert-success mt-4">
            <span>{{ successMessage }}</span>
          </div>-->

          <!-- Mensagem de erro -->
          <!-- <div v-if="errorMessage" class="alert alert-error mt-4">
            <span>{{ errorMessage }}</span>
          </div> -->

        </div>
      </div>
    </main>

  </div>
</template>


<script setup>
import { ref } from 'vue'
import { route } from 'ziggy-js'
import { useForm, usePage } from '@inertiajs/vue3'

// Pega os props do Inertia (auth.user, flash messages, etc.)
const page = usePage()

// Formulário de envio de código
const form = useForm({})

// Success/Errors podem vir do backend via session ou validation errors
// const successMessage = ref(page.props.flash.success || '')
// const errorMessage = ref(page.props.errors?.default || '')

// Função de envio
function sendCode() {
    form.post(route('verification.send'))
}
</script>