<template>
  <div class="w-full">
    <h1 class="text-3xl mb-4 flex justify-center">Your Listings</h1>
    <section class="mb-8 ml-1">
      <Filters :filters="filters" />
    </section>
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
      <Box v-for="listing in listings" :key="listing.id">
        <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
          <div>
            <div class="xl:flex items-center gap-2">
              <Price :price="listing.price" class="text-2xl font-medium" />
            </div>
            <ListingProduct :listing="listing" class="text-lg" />
            <ListingDescription :listing="listing" />
            <ListingAddress :listing="listing" class="text-gray-500" />
          </div>
          <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
            <Link class="btn-outline text-xs font-medium">Preview</Link>
            <Link class="btn-outline text-xs font-medium">Edit</Link>
            <Link :href="route('user.listing.destroy', { listing: listing.id })" method="DELETE" as="button" class="btn-outline text-xs font-medium">Remove</Link>
          </div>
        </div>
      </Box>
    </section>
  </div>
</template>

<script setup>
import ListingProduct from '@/Components/ListingProduct.vue'
import ListingDescription from '@/Components/ListingDescription.vue'
import ListingAddress from '@/Components/ListingAddress.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import Filters from '@/Pages/User/Components/Filters.vue'
import { Link } from '@inertiajs/inertia-vue3'

defineProps({
  listings: Array,
  filters: Object,
})
</script>