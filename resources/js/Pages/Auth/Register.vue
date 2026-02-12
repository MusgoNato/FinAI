<template>
  <AppLayout>
    <div class="flex justify-center mt-12">
      <div class="card w-full max-w-md shadow-2xl bg-base-100">
        <div class="card-body gap-6">

          <!-- Cabeçalho -->
          <div class="text-center">
            <h1 class="text-3xl font-bold text-primary">Crie uma conta</h1>
            <p class="text-sm text-base-content/70">
              Comece a controlar suas finanças agora
            </p>
          </div>

          <!-- Formulário -->
          <form @submit.prevent="submit" class="space-y-4">

            <!-- Nome -->
            <div :class="['form-control', errors.name ? 'text-error' : '']">
              <label class="label"><span class="label-text">Nome</span></label>
              <input
                type="text"
                v-model="form.name"
                :class="['input input-bordered w-full', errors.name ? 'input-error' : '']"
                required
                autofocus
              />
              <span v-if="errors.name" class="text-error text-sm mt-1">{{ errors.name }}</span>
            </div>

            <!-- Email -->
            <div :class="['form-control', errors.email ? 'text-error' : '']">
              <label class="label"><span class="label-text">E-mail</span></label>
              <input
                type="email"
                v-model="form.email"
                :class="['input input-bordered w-full', errors.email ? 'input-error' : '']"
                required
              />
              <span v-if="errors.email" class="text-error text-sm mt-1">{{ errors.email }}</span>
            </div>

            <!-- Senha -->
            <div :class="['form-control', errors.password ? 'text-error' : '']">
              <label class="label"><span class="label-text">Senha</span></label>
              <input
                type="password"
                v-model="form.password"
                :class="['input input-bordered w-full', errors.password ? 'input-error' : '']"
                required
              />
              <span v-if="errors.password" class="text-error text-sm mt-1">{{ errors.password }}</span>
            </div>

            <!-- Confirmação de senha -->
            <div class="form-control">
              <label class="label"><span class="label-text">Confirmar Senha</span></label>
              <input
                type="password"
                v-model="form.password_confirmation"
                class="input input-bordered w-full"
                required
              />
            </div>

            <button class="btn btn-primary w-full mt-2" type="submit">
              Criar Conta
            </button>
          </form>

          <div class="divider">ou</div>

          <p class="text-center text-sm">
            Já tem uma conta?
            <Link :href="route('login')" class="link link-primary font-medium">
              Entrar
            </Link>
          </p>

        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
    import { ref } from 'vue'
    import { Link, useForm } from '@inertiajs/vue3'
    import { route } from 'ziggy-js'

    import AppLayout from '@/Layouts/AppLayout.vue'

    // Formulário reativo
    const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    })

    // Erros do backend
    const errors = ref({})

    // Função de envio
    function submit() {
    form.post(route('register'), {
        onError: (err) => {
        errors.value = err
        },
    })
    }
</script>