<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  links: Array,
})
</script>

<template>
  <nav 
    v-if="links.length > 1" 
    class="flex justify-center mt-6"
  >
    <div class="join">

      <Link
        v-for="(link, index) in links"
        :key="index"
        :href="link.url ?? ''"
        v-html="link.label"
        preserve-scroll
        preserve-state
        class="join-item btn btn-sm md:btn-md"
        :class="[
          link.active ? 'btn-primary pointer-events-none' : 'btn-outline',
          !link.url ? 'btn-disabled' : '',
          // Esconde números no mobile (mantém apenas anterior/próximo)
          index !== 0 && index !== links.length - 1 
            ? 'hidden sm:inline-flex' 
            : ''
        ]"
      />

    </div>
  </nav>
</template>
