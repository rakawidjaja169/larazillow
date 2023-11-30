<template>
  <Box>
    <template #header>Make a Solution</template>
    <div>
      <form @submit.prevent="makeOffer">
        <input v-model.number="form.solution" type="text" class="input" />

        <p class="text-gray-500 font-medium mt-1">Quantity</p>
        <input
          v-model.number="quantityInput"
          type="range" :min="1"
          :max="10" step="1"
          class="mt-2 w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
        />
  
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
import { useForm } from '@inertiajs/vue3'
import { ref, watch } from 'vue'
import { debounce } from 'lodash'

const props = defineProps({
  listingId: Number,
  quantity: Number,
})

const quantityInput = ref(props.quantity)

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

const emit = defineEmits(['quantityUpdated'])
watch(
  () => quantityInput.value, 
  debounce((value) => emit('quantityUpdated', value), 200),
)
</script>