
<script setup>

defineProps({
    modelValue: {
        type: String,
        default: ''
    }
})


const emit = defineEmits(['update:modelValue'])

</script>

<template>
    <select 
    name="type" 
    class="select select-bordered w-full"
    :value="modelValue"
    @change="emit('update:modelValue', $event.target.value)"
    required>
        <option disabled value="">
            Selecione
        </option>
        <option value="Receita">
            Receita
        </option>

        <option value="Despesa">
            Despesa
        </option>
    </select>

</template>
