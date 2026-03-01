<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { computed, onMounted } from 'vue';

const page = usePage()

const errors = computed(() => page.props.errors)

const user = computed(() => page.props.auth.user)


const SuccessMessage = computed(
    () => page.props.flash.success
)


const form = useForm({
    _method: 'PUT',
    name: user.value?.name ?? '',
    email: user.value?.email ?? '',
    profile_image: null,
})

// Atualização da foto de perfil
const handleFileChange = (e) => {
    form.profile_image = e.target.files[0]
}

const UpdateInfoProfile = () => {
    form.post(route('profile.update'), {
        preserveScroll: true,        
        forceFormData: true,
    });
}

</script>

<template>
  <AppLayout>

    <!-- Toast -->
    <div v-if="SuccessMessage"
         class="fixed top-20 left-1/2 -translate-x-1/2 z-50">
      <div class="alert alert-success shadow-xl fade-out">
        <span>{{ SuccessMessage }}</span>
      </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 py-10 space-y-8">

      <!-- Header -->
      <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
          <h1 class="text-3xl font-bold">Editar Perfil</h1>
          <p class="text-base-content/60 text-sm mt-1">
            Atualize suas informações pessoais
          </p>
        </div>

        <Link
          :href="route('profile.show')"
          class="btn btn-outline rounded-xl"
        >
          Voltar
        </Link>
      </div>

      <!-- Card -->
      <div class="card bg-base-100 shadow-2xl rounded-3xl p-8">

        <form
          @submit.prevent="UpdateInfoProfile"
          enctype="multipart/form-data"
          class="space-y-8"
        >

          <!-- Foto de Perfil -->
          <div class="flex flex-col items-center gap-4">

            <div class="avatar">
              <div class="w-28 rounded-full ring ring-primary ring-offset-base-100 ring-offset-4 shadow-md">
                <img
                  :src="form.profile_image
                        ? URL.createObjectURL(form.profile_image)
                        : user.profile_image_url"
                  alt="Profile Image"
                >
              </div>
            </div>

            <div class="w-full max-w-xs">
              <input
                type="file"
                accept="image/*"
                class="file-input file-input-bordered w-full rounded-xl"
                @change="handleFileChange"
              />
              <p class="text-xs text-base-content/50 mt-2 text-center">
                JPG, PNG ou WEBP. Máx 2MB.
              </p>
              <span class="text-error text-sm">
                {{ errors.profile_image }}
              </span>
            </div>

          </div>

          <div class="divider"></div>

          <!-- Nome -->
          <div class="form-control w-full">
            <label class="label">
              <span class="label-text font-medium">Nome</span>
            </label>

            <input
              v-model="form.name"
              type="text"
              class="input input-bordered w-full rounded-xl h-12 focus:input-primary"
              required
            />

            <span class="text-error text-sm mt-1">
              {{ errors.name }}
            </span>
          </div>

          <!-- Email -->
          <div class="form-control w-full">
            <label class="label">
              <span class="label-text font-medium">Email</span>
            </label>

            <input
              v-model="form.email"
              type="email"
              class="input input-bordered w-full rounded-xl h-12 focus:input-primary"
              required
            />

            <span class="text-error text-sm mt-1">
              {{ errors.email }}
            </span>
          </div>

          <!-- Botões -->
          <div class="flex justify-end gap-4 pt-4">

            <Link
              :href="route('profile.show')"
              class="btn btn-outline rounded-xl px-6"
            >
              Cancelar
            </Link>

            <button
              type="submit"
              :disabled="form.processing"
              class="btn btn-primary rounded-xl px-8 shadow-md"
              :class="{ 'loading': form.processing }"
            >
              {{ form.processing ? 'Salvando...' : 'Salvar Alterações' }}
            </button>

          </div>

        </form>

      </div>

    </div>

  </AppLayout>
</template>
