<template>
  <form class="w-full flex justify-center" @submit.prevent="filter">
    <div class="mb-8 mt-4 flex flex-wrap gap-2">
      <div class="flex flex-nowrap items-center">
        <input
          v-model="filterForm.products"
          type="text" placeholder="Product Name"
          class="input-filter w-56"
        />
      </div>
  
      <div class="flex flex-nowrap items-center">
        <select v-model="filterForm.quantity" class="input-filter w-28">
          <option :value="null">Quantity</option>
          <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
          <option :value="6">6+</option>
        </select>
      </div>
  
      <div class="flex flex-nowrap items-center">
        <input
          v-model.number="filterForm.priceFrom"
          type="text" placeholder="Price from"
          class="input-filter-l w-28"
        />
        <input
          v-model.number="filterForm.priceTo"
          type="text" placeholder="Price to" 
          class="input-filter-r w-28"
        />
      </div>
  
      <button type="submit" class="btn-normal">Filter</button>
      <button type="reset" @click="clear">Clear</button>
    </div>
  </form>
</template>

<script setup>
import {useForm} from '@inertiajs/vue3'

const props = defineProps({
  filters: Object,
})

const filterForm = useForm({
  products: props.filters.products ?? null,
  quantity: props.filters.quantity ?? null,
  priceFrom: props.filters.priceFrom ?? null,
  priceTo: props.filters.priceTo ?? null,
})

const filter = () => {
  filterForm.get(
    route('listing.index'),
    {
      preserveState: true,
      preserveScroll: true,
    },
  )
}

const clear = () => {
  filterForm.products = null
  filterForm.quantity = null
  filterForm.priceFrom = null
  filterForm.priceTo = null
  filter()
}
</script>