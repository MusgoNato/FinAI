<script setup>
const props = defineProps({
  modelValue: {
    type: String,
    default: ''
  }
})

const emit = defineEmits(['update:modelValue'])

const update = (event) => {
  emit('update:modelValue', event.target.value)
}
</script>

<template>
  <select
    class="select select-bordered select-sm"
    :value="modelValue"
    @change="update"
  >
    <option value="">Todos</option>
    <option value="Receita">Receita</option>
    <option value="Despesa">Despesa</option>
  </select>
</template>
