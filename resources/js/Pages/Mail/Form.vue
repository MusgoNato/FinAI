<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

const page = usePage()

const form = useForm({
  code: '',
})

function submitCode() {
  form.post(route('verification.verify'))
}

function resendCode() {
  form.post(route('verification.send'))
}
</script>

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
                  d="M12 11c0-3-3-3-3-3m6 3c0-3 3-3 3-3m-9 7h6m-9 4h12a2 2 0 002-2v-5a2 2 0 00-2-2H5a2 2 0 00-2 2v5a2 2 0 002 2z" />
              </svg>
            </div>
          </div>

          <!-- Título -->
          <div>
            <h2 class="text-2xl font-bold text-base-content">
              Confirme seu código
            </h2>
            <p class="text-base-content/60 mt-2 text-sm">
              Enviamos um código de 6 dígitos para:
            </p>
            <p class="font-semibold text-base-content break-all mt-1">
              {{ page.props.auth.user?.email }}
            </p>
          </div>

          <!-- Form -->
          <form @submit.prevent="submitCode" class="space-y-5">

            <!-- Campo Código -->
            <input
              type="text"
              v-model="form.code"
              maxlength="6"
              inputmode="numeric"
              placeholder="000000"
              class="input input-bordered w-full h-16 text-center text-2xl tracking-[0.5em] rounded-2xl shadow-sm focus:input-primary"
              required
              autofocus
            />

            <div v-if="form.errors.code" class="text-error text-sm font-medium">
              {{ form.errors.code }}
            </div>

            <!-- Botão confirmar -->
            <button
              type="submit"
              class="btn btn-primary w-full h-14 rounded-2xl text-lg font-bold shadow-lg shadow-primary/30 hover:scale-[1.02] active:scale-[0.98] transition-transform"
              :class="{ 'loading': form.processing }"
              :disabled="form.processing"
            >
              Confirmar código
            </button>

          </form>

          <div class="divider my-6 text-xs uppercase tracking-widest text-base-content/40">
            ou
          </div>

          <!-- Reenviar -->
          <div class="text-sm text-base-content/60">
            Não recebeu o código?
            <button
              @click="resendCode"
              class="text-primary font-semibold hover:underline ml-1"
              :disabled="form.processing"
            >
              Reenviar
            </button>
          </div>

          <!-- Feedback sucesso -->
          <div v-if="page.props.flash?.status"
               class="alert alert-success rounded-2xl text-sm mt-4">
            <span>{{ page.props.flash.status }}</span>
          </div>

        </div>
      </div>

    </div>

  </div>
</template>

<style scoped>
.input, .btn {
  border-radius: 1rem;
}
</style>
