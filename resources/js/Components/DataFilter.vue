<script setup>

const props = defineProps({
  start_date: String,
  end_date: String
})

const emit = defineEmits([
  'update:start_date',
  'update:end_date'
])

</script>

<template>
  <div class="flex gap-2 flex-wrap">
    <input
      type="date"
      :value="start_date"
      @input="emit('update:start_date', $event.target.value)"
      class="input input-bordered input-sm"
    />

    <input
      type="date"
      :value="end_date"
      @input="emit('update:end_date', $event.target.value)"
      class="input input-bordered input-sm"
    />
  </div>
</template>
