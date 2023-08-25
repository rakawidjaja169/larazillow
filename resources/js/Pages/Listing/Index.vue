<template>
  <ListingTable :listings="listings" />
</template>

<script setup>
import ListingTable from '@/Components/ListingTable.vue'
defineProps({
  listings: Array,
})
</script>