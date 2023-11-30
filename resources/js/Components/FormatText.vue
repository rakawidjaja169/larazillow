<template>
  <span>{{ formattedText }}</span>
</template>
  
<script setup>
import { computed } from 'vue'

const props = defineProps({
  text: [String, Object],
})

const formattedText = computed(() => {
  let textToFormat = props.text
  
  if (typeof props.text === 'object') {
    // Convert the object to a string (you can customize this based on your object's structure)
    textToFormat = JSON.stringify(props.text)
  }
  
  // Format the text
  return textToFormat
    .replace(/["[\]]+/g, '')
    .split('-')
    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
    .join(' ')
    .replace(/\b\w/g, (char) => char.toUpperCase()) // Capitalize the first letter of every word
})
</script>