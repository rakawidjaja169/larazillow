<template>
  <div>
    <span class="font-bold">{{ listing.products }}</span>
    <span class="text-gray-400"> | </span>  
    <span class="font-bold">{{ quantity }}</span>
  </div>
</template>
  
<script setup>
defineProps({
  listing: Object,
  quantity: Number,
})
</script>