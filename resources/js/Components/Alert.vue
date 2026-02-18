<template>
  <transition name="fade">
    <div
      v-if="visible"
      class="fixed top-20 left-1/2 -translate-x-1/2 z-50"
    >
      <div
        :class="[
          'shadow-xl rounded-2xl w-96 p-4 text-white flex justify-between items-center',
          alertClasses
        ]"
      >
        <span>{{ message }}</span>

        <button
          @click="close"
          class="ml-4 text-lg font-bold opacity-70 hover:opacity-100"
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
    'bg-green-500': props.type === 'success',
    'bg-red-500': props.type === 'error',
    'bg-yellow-500': props.type === 'warning',
    'bg-blue-500': props.type === 'info'
  }
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
