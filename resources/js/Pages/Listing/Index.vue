<template>
  <div class="w-full flex flex-col">
    <Link 
      class="btn-primary w-40 mb-2 text-center" 
      :href="route('user.listing.create')"
    >
      <p>Create New Listing</p>
    </Link>
  </div>

  <Filters :filters="filters" />

  <ListingTable :listings="listings" />

  <div v-if="listings.data.length || listings.data.length === 0" class="w-full flex justify-center mt-8 mb-8">
    <Pagination :links="listings.links" />
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Filters from '@/Pages/Listing/Components/Filters.vue'
import ListingTable from '@/Components/ListingTable.vue'
import Pagination from '@/Components/UI/Pagination.vue'

defineProps({
  listings: Object,
  filters: Object,
})
</script>