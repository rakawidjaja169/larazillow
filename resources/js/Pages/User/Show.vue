<template>
  <div class="mb-4">
    <Link 
      :href="route('user.listing.index')"
    >
      ← Go back to Listings
    </Link>
  </div>

  <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
    <Box v-if="!hasOffers" class="flex md:col-span-7 items-center">
      <div class="w-full text-center font-medium text-gray-500">
        No offers
      </div>
    </Box>

    <div v-else class="md:col-span-7 items-center">
      This is displayed when there are offers!
    </div>

    <Box class="md:col-span-5">
      <template #header>
        Basic info
      </template>
      <Price :price="listing.price" class="text-2xl font-bold" />
      <div class="text-lg">
        <ListingProduct :listing="listing" :quantity="offer" />
      </div>
      <div>
        <ListingDescription :listing="listing" />
      </div>
      <div class="text-gray-500">
        <ListingAddress :listing="listing" />
      </div>
    </Box>
  </section>
</template>

<script setup>
import ListingProduct from '@/Components/ListingProduct.vue'
import ListingDescription from '@/Components/ListingDescription.vue'
import ListingAddress from '@/Components/ListingAddress.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { Link } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'

const props = defineProps({ listing: Object })
const hasOffers = computed(
  () => props.listing.offers.length,
)
</script>