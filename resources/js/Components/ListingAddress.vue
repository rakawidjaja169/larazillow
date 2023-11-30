<template>
  <div>
    <span>{{ listing.address }}</span>
  </div>
</template>
    
<script setup>
defineProps({
  listing: Object,
})
</script>