<template>
  <div>
    <ListingProduct :listing="listing" />
  </div>
</template>

<script setup>
import ListingProduct from '@/Components/ListingProduct.vue'

defineProps({
  listing: Object,
})
</script>