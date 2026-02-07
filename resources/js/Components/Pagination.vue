<script setup>
import { Link } from '@inertiajs/vue3';


defineProps({
    links: Array,
})
</script>

<template>
  <nav v-if="links.length > 1" class="flex gap-1">
    <Link
      v-for="(link, index) in links"
      :key="index"
      :href="link.url ?? ''"
      v-html="link.label"
      class="px-3 py-1 rounded text-sm"
      :class="{
        'bg-base-300 pointer-events-none': link.active,
        'text-gray-400 pointer-events-none': !link.url,
      }"
      preserve-scroll
      preserve-state
    />
  </nav>
</template>