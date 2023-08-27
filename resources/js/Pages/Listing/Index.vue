<template>
  <Filters :filters="filters" />

  <ListingTable :listings="listings" />

  <div v-if="listings.data.length || listings.data.length === 0" class="w-full flex justify-center mt-8 mb-8">
    <Pagination :links="listings.links" />
  </div>
</template>

<script setup>
import Filters from '@/Pages/Listing/Components/Filters.vue'
import ListingTable from '@/Components/ListingTable.vue'
import Pagination from '@/Components/UI/Pagination.vue'

defineProps({
  listings: Object,
  filters: Object,
})
</script>