<template>
  <AppLayout>
    <div class="min-h-screen flex items-center justify-center bg-[#F3F4F6] p-4 sm:p-8">
      <div class="flex flex-col lg:flex-row w-full max-w-6xl bg-white rounded-[3rem] shadow-2xl overflow-hidden min-h-187.5">
        
        <!-- LADO ESQUERDO - SLIDER -->
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
          
          <!-- Slides -->
          <div
            v-for="(image, index) in images"
            :key="index"
            class="absolute inset-0 transition-opacity duration-1000"
            :class="currentIndex === index ? 'opacity-100 z-10' : 'opacity-0 z-0'"
          >
            <div
              class="absolute inset-0 bg-cover bg-center transition-transform duration-6000ms ease-in-out scale-110"
              :style="{ backgroundImage: `url(${image})` }"
            >
              <div class="absolute inset-0 bg-black/60 backdrop-blur-[2px]"></div>
            </div>
          </div>

          <!-- Conteúdo -->
          <div class="relative z-20 flex flex-col items-center justify-center w-full h-full text-center p-12 text-white">
            <span class="text-4xl font-light mb-4 opacity-80 italic">FinAI</span>

            <h2 class="text-5xl font-black mb-6 leading-tight tracking-tight">
              Comece sua <br/>
              <span class="text-primary">liberdade financeira.</span>
            </h2>

            <p class="text-xl opacity-70 max-w-sm leading-relaxed">
              Organize receitas, despesas e conquiste seus objetivos.
            </p>

            <!-- Indicadores -->
            <div class="flex gap-2 mt-12">
              <div
                v-for="(image, index) in images"
                :key="'dot-' + index"
                class="w-2 h-2 rounded-full transition-all duration-300"
                :class="currentIndex === index ? 'bg-white scale-125' : 'bg-white/30'"
              ></div>
            </div>
          </div>
        </div>

        <!-- LADO DIREITO - FORM -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center p-8 sm:p-16 bg-white">
          <div class="w-full max-w-md mx-auto">

            <!-- Cabeçalho -->
            <div class="mb-10 text-center lg:text-left">
              <h3 class="text-base-content/40 font-semibold mb-2">FinAI</h3>
              <h1 class="text-4xl font-black text-base-content mb-2 tracking-tight">
                Crie sua conta
              </h1>
              <p class="text-lg text-base-content/60 font-medium">
                Comece a controlar suas finanças hoje
              </p>
            </div>

            <!-- Form -->
            <form @submit.prevent="submit" class="space-y-5">

              <!-- Nome -->
              <div>
                <label class="label">
                  <span class="label-text font-bold text-base-content/70">Nome</span>
                </label>
                <input
                  type="text"
                  v-model="form.name"
                  placeholder="Seu nome"
                  class="input input-bordered w-full h-14 rounded-2xl shadow-sm focus:input-primary"
                  required
                />
                <span v-if="errors.name" class="text-error text-xs mt-1 font-medium">
                  {{ errors.name }}
                </span>
              </div>

              <!-- Email -->
              <div>
                <label class="label">
                  <span class="label-text font-bold text-base-content/70">E-mail</span>
                </label>
                <input
                  type="email"
                  v-model="form.email"
                  placeholder="email@exemplo.com"
                  class="input input-bordered w-full h-14 rounded-2xl shadow-sm focus:input-primary"
                  required
                />
                <span v-if="errors.email" class="text-error text-xs mt-1 font-medium">
                  {{ errors.email }}
                </span>
              </div>

              <!-- Senha -->
              <div>
                <label class="label">
                  <span class="label-text font-bold text-base-content/70">Senha</span>
                </label>
                <input
                  type="password"
                  v-model="form.password"
                  placeholder="••••••••"
                  class="input input-bordered w-full h-14 rounded-2xl shadow-sm focus:input-primary"
                  required
                />
                <span v-if="errors.password" class="text-error text-xs mt-1 font-medium">
                  {{ errors.password }}
                </span>
              </div>

              <!-- Confirmar -->
              <div>
                <label class="label">
                  <span class="label-text font-bold text-base-content/70">Confirmar senha</span>
                </label>
                <input
                  type="password"
                  v-model="form.password_confirmation"
                  placeholder="Repita sua senha"
                  class="input input-bordered w-full h-14 rounded-2xl shadow-sm focus:input-primary"
                  required
                />
              </div>

              <button
                type="submit"
                class="btn btn-primary w-full h-14 rounded-2xl shadow-lg shadow-primary/30 text-lg font-bold hover:scale-[1.02] active:scale-[0.98] transition-transform"
                :disabled="form.processing"
              >
                Criar Conta
              </button>

            </form>

            <div class="divider my-8 text-xs uppercase tracking-widest text-base-content/40">
              ou
            </div>

            <p class="text-center text-sm text-base-content/60">
              Já tem uma conta?
              <Link :href="route('login')" class="text-primary font-bold hover:underline ml-1">
                Entrar
              </Link>
            </p>

          </div>
        </div>

      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import AppLayout from '@/Layouts/AppLayout.vue'

/* IMAGENS DO SLIDER */
const images = [
  'https://images.unsplash.com/photo-1554224155-6726b3ff858f?q=80&w=2022&auto=format&fit=crop',
  'https://images.unsplash.com/photo-1563013544-824ae1b704d3?q=80&w=2070&auto=format&fit=crop',
  'https://images.unsplash.com/photo-1556740749-887f6717d7e4?q=80&w=2070&auto=format&fit=crop'
]

const currentIndex = ref(0)
let interval = null

onMounted(() => {
  interval = setInterval(() => {
    currentIndex.value = (currentIndex.value + 1) % images.length
  }, 5000)
})

onBeforeUnmount(() => {
  clearInterval(interval)
})

/* FORM */
const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
})

const errors = ref({})

function submit() {
  form.post(route('register'), {
    onError: (err) => {
      errors.value = err
    },
  })
}
</script>

<style scoped>
.input, .btn {
  border-radius: 1rem;
}

.flex {
  animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(5px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
