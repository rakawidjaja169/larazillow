<template>
  <form @submit.prevent="create">
    <div class="grid grid-cols-6 gap-4 max-w-7xl justify-center">
      <div class="col-span-4">
        <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Products</label>
        <input v-model="form.products" type="text" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
        <div v-if="form.errors.products">
          {{ form.errors.products }}
        </div>
      </div>
  
      <div class="col-span-2">
        <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Quantity</label>
        <input v-model.number="form.quantity" type="text" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
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