<template>
  <span>{{ formattedText }}</span>
</template>
  
<script setup>
import { computed } from 'vue'

const props = defineProps({
  permission: [String],
})

const formattedText = computed(
  () => props.permission
    .split('-')
    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
    .join(' ')
    .replace(/\b\w/g, (char) => char.toUpperCase()), // Capitalize the first letter of every word
)
</script>