<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import Alert from '@/Components/Alert.vue';
import { useFlash } from '@/Composables/useFlash';
const { alertType, alertMessage } = useFlash();

const page = usePage()
const user = page.props.auth.user

const form = useForm({})
 

const handleDelete = () => {
    if(confirm('Tem certeza que deseja excluir sua conta?')){
        form.delete(route('profile.destroy'), {
            onBefore: () => confirm('Esta ação não pode ser desfeita. Continuar?'),
            onFinish: () => form.reset,
        });
    }
}

</script>


<template>
  <AppLayout>

    <Alert v-if="alertMessage" :message="alertMessage" :type="alertType" />

    <div class="max-w-6xl mx-auto px-4 py-10 space-y-8">

      <!-- Header -->
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
          <h1 class="text-3xl font-bold">Meu Perfil</h1>
          <p class="text-base-content/60 text-sm mt-1">
            Gerencie suas informações e configurações da conta
          </p>
        </div>

        <Link
          :href="route('profile.edit')"
          class="btn btn-primary rounded-xl shadow-md"
        >
          Editar Perfil
        </Link>
      </div>

      <!-- Layout principal -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <!-- Card Perfil -->
        <div class="card bg-base-100 shadow-xl rounded-3xl p-8 text-center">

          <div class="flex justify-center">
            <div class="avatar">
              <div class="w-28 rounded-full ring ring-primary ring-offset-base-100 ring-offset-4 shadow-md">
                <img :src="user.profile_image_url" alt="Profile Image">
              </div>
            </div>
          </div>

          <h2 class="text-2xl font-bold mt-6">{{ user.name }}</h2>
          <p class="text-base-content/60 break-all">{{ user.email }}</p>

          <div class="divider my-6"></div>

          <div class="space-y-4 text-sm">

            <div class="flex justify-between">
              <span class="text-base-content/60">Usuário desde</span>
              <span class="font-medium">
                {{ user.created_at_formatted }}
              </span>
            </div>

            <div class="flex justify-between">
              <span class="text-base-content/60">Status da conta</span>
              <span class="badge badge-success badge-outline">
                Ativa
              </span>
            </div>

          </div>

        </div>

        <!-- Card Ações -->
        <div class="lg:col-span-2">

          <div class="card bg-base-100 shadow-xl rounded-3xl p-8 space-y-6">

            <div>
              <h2 class="text-xl font-bold">Configurações da Conta</h2>
              <p class="text-base-content/60 text-sm">
                Atualize suas informações ou gerencie segurança
              </p>
            </div>

            <div class="space-y-4">

              <Link
                :href="route('profile.edit')"
                class="btn btn-primary w-full h-14 rounded-xl text-base font-semibold"
              >
                Editar Informações
              </Link>

              <Link
                :href="route('profile.password')"
                class="btn btn-outline btn-secondary w-full h-14 rounded-xl text-base font-semibold"
              >
                Alterar Senha
              </Link>

              <div class="divider"></div>

              <button
                @click="handleDelete"
                :disabled="form.processing"
                class="btn btn-error btn-outline w-full h-14 rounded-xl font-semibold"
              >
                {{ form.processing ? 'Excluindo conta...' : 'Excluir Conta' }}
              </button>

            </div>

          </div>

        </div>

      </div>
    </div>

  </AppLayout>
</template>

