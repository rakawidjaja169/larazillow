<template>
  <form @submit.prevent="create">
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
        <button type="submit">Create</button>
      </div>
    </div>
  </form>
</template>
  
<script setup>
import { useForm } from '@inertiajs/inertia-vue3'
const form = useForm({
  products: null,
  quantity: 0,
  description: null,
  address: null,
  price: 0,
})
const create = () => form.post(route('listing.store'))
</script>
  
<style scoped>
  label {
    margin-right: 2em;
  }
  div {
    padding: 2px
  }
</style>