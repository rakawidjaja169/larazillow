<template>
  <div class="w-full">
    <Box class="mx-auto md:w-1/2">
      <template #header>Upload New Images</template>
      <form @submit.prevent="upload">
        <input type="file" multiple @input="addFiles" />
        <button type="submit" class="btn-outline">Upload</button>
        <button type="reset" class="btn-outline" @click="reset">Reset</button>
      </form>
    </Box>
  </div>
</template>
  
<script setup>
import Box from '@/Components/UI/Box.vue'
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({ listing: Object })
const form = useForm({
  images: [],
})

const upload = () => {
  form.post(
    route('user.listing.image.store', { listing: props.listing.id }),
    {
      onSuccess: () => form.reset('images'),
    },
  )
}

const addFiles = (event) => {
  for (const image of event.target.files) {
    form.images.push(image)
  }
}

const reset = () => form.reset('images')
</script>