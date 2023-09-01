<template>
  <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="max-w-7xl text-sm text-left text-gray-500 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" class="p-4">
            <div class="flex items-center">
              <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
              <label for="checkbox-all-search" class="sr-only">checkbox</label>
            </div>
          </th>
          <th scope="col" class="px-6 py-3">
            Product name
          </th>
          <th scope="col" class="px-6 py-3">
            Quantity
          </th>
          <th scope="col" class="px-6 py-3">
            Address
          </th>
          <th scope="col" class="px-6 py-3">
            Price
          </th>
          <th scope="col" class="px-6 py-3">
            Monthly Payment
          </th>
          <!-- <th scope="col" class="px-6 py-3">
            Action
          </th> -->
        </tr>
      </thead>
      <tbody>
        <tr v-if="listings.data.length === 0" class="bg-white dark:bg-gray-800">
          <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
            No Data
          </td>
        </tr>
        <tr
          v-for="listing in listings.data"
          :key="listing.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
        >
          <td class="w-4 p-4">
            <div class="flex items-center">
              <input :id="'checkbox-table-search-' + listing.id" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
              <label :for="'checkbox-table-search-' + listing.id" class="sr-only">checkbox</label>
            </div>
          </td>
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
            <Price :price="listing.price" />
          </td>
          <MonthlyPayment :listing="listing" />
          <!-- <td class="flex items-center px-6 py-4 space-x-3">
            <Link :href="route('listing.edit', { listing: listing.id })" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
          </td> -->
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Price from '@/Components/Price.vue'
import MonthlyPayment from '@/Components/MonthlyPayment.vue'

defineProps({
  listings: Object,
})
</script>