<template>
  <div v-for="listing in listings" :key="listing.id">
    <Link :href="`/listing/${listing.id}`">
      <ListingProduct :listing="listing" />
    </Link>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import ListingProduct from '@/Components/ListingProduct.vue'
defineProps({
  listings: Array,
})
</script>