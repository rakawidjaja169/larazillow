<template>
  <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
    <Link :href="route('listing.show', { listing: listing.id })">
      {{ listing.products }}
    </Link>
  </th>
  <td class="px-6 py-4">
    {{ listing.quantity }}
  </td>
  <td class="px-6 py-4">
    {{ listing.address }}
  </td>
  <td class="px-6 py-4">
    {{ listing.price }}
  </td>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
defineProps({
  listing: Object,
})
</script>