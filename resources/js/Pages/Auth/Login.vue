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
                            Organize suas <br/> 
                            <span class="text-primary">finanças.</span>
                        </h2>

                        <p class="text-xl opacity-70 max-w-sm leading-relaxed">
                            Controle seus gastos e receitas de forma inteligente e intuitiva.
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
                        <div class="mb-10 text-center lg:text-left">
                            <h3 class="text-base-content/40 font-semibold mb-2">FinAI</h3>
                            <h1 class="text-4xl font-black text-base-content mb-2 tracking-tight">
                                Acesse sua conta
                            </h1>
                            <p class="text-lg text-base-content/60 font-medium">
                                Bem-vindo de volta!
                            </p>
                        </div>

                        <form @submit.prevent="submit" class="space-y-6">
                            
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-base-content/70">E-mail</span>
                                    <Link :href="route('password.request')" class="label-text-alt link link-primary no-underline font-semibold">
                                        Esqueceu a senha?
                                    </Link>
                                </label>
                                <input
                                    v-model="form.email"
                                    type="email"
                                    placeholder="email@exemplo.com"
                                    class="input input-bordered w-full h-14 rounded-2xl bg-base-100 border-base-300 focus:input-primary transition-all shadow-sm"
                                    required
                                    autofocus
                                />
                                <span v-if="errors.email" class="text-error text-xs mt-1 font-medium">
                                    {{ errors.email }}
                                </span>
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-base-content/70">Senha</span>
                                </label>
                                <input
                                    v-model="form.password"
                                    type="password"
                                    placeholder="sua senha"
                                    class="input input-bordered w-full h-14 rounded-2xl bg-base-100 border-base-300 focus:input-primary transition-all shadow-sm"
                                    required
                                />
                                <span v-if="errors.password" class="text-error text-xs mt-1 font-medium">
                                    {{ errors.password }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between py-2">
                                <label class="cursor-pointer flex items-center gap-3 group">
                                    <input type="checkbox" v-model="form.remember" class="checkbox checkbox-primary rounded-lg border-2" />
                                    <span class="label-text font-semibold text-base-content/60 group-hover:text-base-content transition-colors">
                                        Lembrar-me
                                    </span>
                                </label>
                            </div>

                            <div v-if="form.errors.message" class="text-error text-sm font-bold text-center">
                                {{ form.errors.message }}
                            </div>

                            <button 
                                type="submit" 
                                class="btn btn-primary w-full h-14 rounded-2xl shadow-lg shadow-primary/30 normal-case text-lg font-bold hover:scale-[1.02] active:scale-[0.98] transition-transform"
                                :disabled="form.processing"
                            >
                                Entrar
                            </button>
                        </form>

                        <div class="divider my-10 text-base-content/30 font-bold text-xs uppercase tracking-widest text-center">
                            ou
                        </div>

                        <a :href="route('google.redirect')" 
                           class="btn btn-outline w-full h-14 rounded-2xl border-base-300 hover:bg-base-100 hover:border-base-400 gap-4 group transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" class="w-6 h-6 transition-transform group-hover:scale-110">
                                <path fill="#EA4335" d="M24 9.5c3.15 0 5.93 1.08 8.14 2.85l6.1-6.1C34.51 2.43 29.64 0 24 0 14.6 0 6.55 5.38 2.62 13.22l7.1 5.52C11.61 13.03 17.33 9.5 24 9.5z"/>
                                <path fill="#4285F4" d="M46.1 24.5c0-1.56-.14-3.06-.39-4.5H24v9h12.4c-.53 2.87-2.13 5.3-4.53 6.94l7.02 5.47C43.63 37.07 46.1 31.3 46.1 24.5z"/>
                                <path fill="#FBBC05" d="M9.72 28.74c-.48-1.44-.76-2.97-.76-4.74s.28-3.3.76-4.74l-7.1-5.52C.9 17.1 0 20.45 0 24s.9 6.9 2.62 10.26l7.1-5.52z"/>
                                <path fill="#34A853" d="M24 48c6.48 0 11.93-2.14 15.9-5.8l-7.02-5.47c-1.95 1.31-4.44 2.08-8.88 2.08-6.67 0-12.39-3.53-14.28-8.74l-7.1 5.52C6.55 42.62 14.6 48 24 48z"/>
                            </svg>
                            <span class="text-base-content font-bold">Entrar com Google</span>
                        </a>

                        <div class="mt-12 text-center">
                            <span class="text-base-content/60 font-medium">
                                Ainda não tem conta?
                            </span>
                            <Link :href="route('register')" class="text-primary font-bold ml-2 hover:underline">
                                Criar conta
                            </Link>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { Link, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import { route } from 'ziggy-js'

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

const form = useForm({
    email: '',
    password: '',
    remember: false,
})

const errors = ref({})

function submit() {
    form.post(route('login'), {
        onError: (err) => {
            errors.value = err
        }
    })
}
</script>

<style scoped>
.input, .btn, .checkbox {
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
