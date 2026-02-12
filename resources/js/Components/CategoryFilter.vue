<script setup>
const props = defineProps({
  modelValue: {
    category: String,
    default: ''
  }
})

const emit = defineEmits(['update:modelValue'])

const update = (event) => {
  emit('update:modelValue', event.target.value)
}
</script>

<template>
    <select class="select select-bordered select-sm"
    :value="modelValue"
    @change="update">
        <option value="">Todos</option>
        <option value="Alimentacao">Alimentação</option>
        <option value="Renda">Renda</option>
        <option value="Transporte">Transporte</option>
        <option value="Lazer">Lazer</option>
        <option value="Outros">Outros</option>
    </select>
</template>
