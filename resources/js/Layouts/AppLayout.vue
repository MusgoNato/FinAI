<!-- Scripts -->
<script setup>
import { usePage } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue'

const page = usePage()
</script>

<!-- Template -->
<template>
  <div class="min-h-screen bg-base-200">

    <!-- Componente de navegacao -->
    <Navbar v-if="page.props.auth.user"/>

    <main class="flex min-h-auto items-center justify-center px-4 mt-10">
      <!-- Slot eh igual a variavel do Blade $slot que eh injetada via Laravel -->
      <slot />
    </main>
  </div>
</template>

<!-- Styles -->
