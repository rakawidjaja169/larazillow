<template>
  <ListingTable :listings="listings" />

  <div v-if="listings.data.length" class="w-full flex justify-center mt-8 mb-8">
    <Pagination :links="listings.links" />
  </div>
</template>

<script setup>
import ListingTable from '@/Components/ListingTable.vue'
import Pagination from '@/Components/UI/Pagination.vue'

defineProps({
  listings: Object,
})
</script>