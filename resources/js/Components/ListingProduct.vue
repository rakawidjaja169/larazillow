<template>
  <span>
    {{ listing.products }} {{ listing.quantity }}, {{ listing.address }}, for {{ listing.price }}
  </span>
</template>

<script setup>
defineProps({
  listing: Object,
})
</script>