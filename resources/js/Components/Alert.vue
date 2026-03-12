<template>
  <transition name="fade">
    <div
      v-if="visible"
      class="fixed top-20 left-1/2 -translate-x-1/2 z-50"
    >
      <div
        :class="[
          'shadow-lg rounded-2xl w-96 p-4 flex justify-between items-center border',
          alertClasses
        ]"
      >
        <div class="flex items-center gap-3">
          <span class="text-xl">{{ alertIcon }}</span>
          <span class="text-sm font-medium">{{ message }}</span>
        </div>
        <button
          @click="close"
          class="ml-4 text-lg font-bold opacity-50 hover:opacity-100 transition-opacity"
        >
          ×
        </button>
      </div>
    </div>
  </transition>
</template>

<script setup>
import { ref, watch, computed } from 'vue'

const props = defineProps({
  message: {
    type: String,
    required: true
  },
  type: {
    type: String,
    default: 'success' // success | error | warning | info
  },
  duration: {
    type: Number,
    default: 3000
  },
  autoClose: {
    type: Boolean,
    default: true
  }
})

const visible = ref(true)

const alertClasses = computed(() => {
  return {
    // Success — verde suave com fundo claro
    'bg-emerald-50 text-emerald-800 border-emerald-200': props.type === 'success',
    // Error — vermelho rosado com fundo claro
    'bg-rose-50 text-rose-800 border-rose-200': props.type === 'error',
    // Warning — âmbar suave com fundo claro
    'bg-amber-50 text-amber-800 border-amber-200': props.type === 'warning',
    // Info — azul índigo suave com fundo claro
    'bg-sky-50 text-sky-800 border-sky-200': props.type === 'info',
  }
})

const alertIcon = computed(() => {
  return {
    success: '✅',
    error: '❌',
    warning: '⚠️',
    info: 'ℹ️',
  }[props.type] ?? 'ℹ️'
})

const close = () => {
  visible.value = false
}

watch(
  () => props.message,
  () => {
    visible.value = true
    if (props.autoClose) {
      setTimeout(() => {
        close()
      }, props.duration)
    }
  },
  { immediate: true }
)
</script>

<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>