<script setup>

defineProps({
    modelValue: {
        category: String,
        default: ''
    }
})


const emit = defineEmits(['update:modelValue'])
</script>

<template>
  <select
    name="category"
    class="select select-bordered w-full"
    :value="modelValue"
    @change="emit('update:modelValue', $event.target.value)"
    required>
    <option disabled value="">Selecione</option>

    <option value="Alimentacao">Alimentação</option>
    <option value="Renda">Renda</option>
    <option value="Transporte">Transporte</option>
    <option value="Lazer">Lazer</option>
    <option value="Outros">Outros</option>
  </select>
</template>
