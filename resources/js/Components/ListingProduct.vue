<template>
  <div>
    <span class="font-bold">{{ listing.products }}</span>
    <span class="text-gray-400"> | </span>  
    <span class="font-bold">{{ listing.quantity }}</span>
  </div>
</template>
  
<script setup>
defineProps({
  listing: Object,
})
</script>