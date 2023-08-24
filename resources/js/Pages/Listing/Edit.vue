<template>
  <form @submit.prevent="update">
    <div>
      <div>
        <label>Products</label>
        <input v-model="form.products" type="text" />
        <div v-if="form.errors.products">
          {{ form.errors.products }}
        </div>
      </div>
  
      <div>
        <label>Quantity</label>
        <input v-model.number="form.quantity" type="text" />
        <div v-if="form.errors.quantity">
          {{ form.errors.quantity }}
        </div>
      </div>
  
      <div>
        <label>Description</label>
        <input v-model="form.description" type="text" />
        <div v-if="form.errors.description">
          {{ form.errors.description }}
        </div>
      </div>
  
      <div>
        <label>Address</label>
        <input v-model="form.address" type="text" />
        <div v-if="form.errors.address">
          {{ form.errors.address }}
        </div>
      </div>
  
      <div>
        <label>Price</label>
        <input v-model.number="form.price" type="text" />
        <div v-if="form.errors.price">
          {{ form.errors.price }}
        </div>
      </div>
  
      <div>
        <button type="submit">Edit</button>
      </div>
    </div>
  </form>
</template>
  
<script setup>
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
  listing: Array,
})

const form = useForm({
  products: props.listing.products,
  quantity: props.listing.quantity,
  description: props.listing.description,
  address: props.listing.address,
  price: props.listing.price,
})
const update = () => form.put(route('listing.update', { listing: props.listing.id }))
</script>
  
<style scoped>
  label {
    margin-right: 2em;
  }
  div {
    padding: 2px
  }
</style>