<template>
  <form method="POST" :action="route('user.listing.image.store', { listing: listing.id })">
    <input type="file" multiple name="files" />
    <button type="submit">Send</button>
  </form>
</template>
  
<script setup>
defineProps({ listing: Object })
</script>