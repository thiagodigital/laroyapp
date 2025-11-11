<script setup lang="ts">
const emit = defineEmits(['submit'])

function handleSubmit(event: Event) {
  emit('submit', event)
}
defineProps({
  cls: {
    type: String,
  },
  action: {
    type: String,
  },
})
</script>
<template>
  <form :class="cls" :action="action" method="POST" @submit.prevent="handleSubmit">
    <slot />
  </form>
</template>
