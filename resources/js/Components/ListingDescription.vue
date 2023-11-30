<template>
  <div>
    <span>{{ listing.description }}</span>
  </div>
</template>
    
<script setup>
defineProps({
  listing: Object,
})
</script>