<template>
  <div class="min-h-screen bg-[#F3F4F6] flex items-center justify-center p-4">

    <div class="w-full max-w-md">

      <div class="card bg-white shadow-2xl rounded-3xl">
        <div class="card-body text-center p-10 space-y-6">

          <!-- Ícone -->
          <div class="flex justify-center">
            <div class="w-20 h-20 rounded-full bg-primary/10 flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M16 12H8m8 0a4 4 0 01-8 0m8 0V8a4 4 0 10-8 0v4" />
              </svg>
            </div>
          </div>

          <!-- Título -->
          <div>
            <h2 class="text-2xl font-bold text-base-content">
              Verificação de E-mail
            </h2>
            <p class="text-base-content/60 mt-2 text-sm">
              Para continuar, confirme seu endereço de e-mail.
            </p>
          </div>

          <!-- Email -->
          <div class="bg-base-200 rounded-2xl py-3 px-4 text-sm">
            <p class="text-base-content/60">Código será enviado para:</p>
            <p class="font-semibold text-base-content break-all">
              {{ page.props.auth.user?.email }}
            </p>
          </div>

          <!-- Botão -->
          <button
            @click="sendCode"
            class="btn btn-primary w-full h-14 rounded-2xl text-lg font-bold shadow-lg shadow-primary/30 hover:scale-[1.02] active:scale-[0.98] transition-transform"
            :class="{ 'loading': form.processing }"
            :disabled="form.processing"
          >
            Enviar código de verificação
          </button>

          <!-- Status -->
          <div v-if="page.props.flash?.status" class="alert alert-success rounded-2xl text-sm">
            <span>{{ page.props.flash.status }}</span>
          </div>

          <p class="text-xs text-base-content/40">
            Verifique também sua caixa de spam.
          </p>

        </div>
      </div>

    </div>

  </div>
</template>

<script setup>
import { route } from 'ziggy-js'
import { useForm, usePage } from '@inertiajs/vue3'

const page = usePage()
const form = useForm({})

function sendCode() {
  form.post(route('verification.send'))
}
</script>

<style scoped>
.btn {
  border-radius: 1rem;
}
</style>
