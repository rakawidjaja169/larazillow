<template>
  <Box>
    <template #header>Make a Solution</template>
    <div>
      <form @submit.prevent="makeOffer">
        <input v-model.number="form.solution" type="text" class="input" />
  
        <button type="submit" class="btn-outline w-full mt-2 text-sm">
          Submit
        </button>

        {{ form.errors.amount }}
      </form>
    </div>
  </Box>
</template>
  
<script setup>
import Box from '@/Components/UI/Box.vue'
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
  listingId: Number,
})

const form = useForm({
  solution: null,
})

const makeOffer = () => form.post(
  route('listing.offer.store', 
    { listing: props.listingId },
  ),
  {
    preserveScroll: true,
    preserveState: true,
  },
)
</script>