<template>
  <form @submit.prevent="create">
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-4">
        <label class="label">Products</label>
        <input v-model="form.products" type="text" class="input" />
        <div v-if="form.errors.products">
          {{ form.errors.products }}
        </div>
      </div>
  
      <div class="col-span-2">
        <label class="label">Quantity</label>
        <input v-model.number="form.quantity" type="text" class="input" />
        <div v-if="form.errors.quantity">
          {{ form.errors.quantity }}
        </div>
      </div>
  
      <div class="col-span-6">
        <label class="label">Description</label>
        <input v-model="form.description" type="text" class="input" />
        <div v-if="form.errors.description">
          {{ form.errors.description }}
        </div>
      </div>
  
      <div class="col-span-6">
        <label class="label">Address</label>
        <input v-model="form.address" type="text" class="input" />
        <div v-if="form.errors.address">
          {{ form.errors.address }}
        </div>
      </div>
  
      <div class="col-span-6">
        <label class="label">Price</label>
        <input v-model.number="form.price" type="text" class="input" />
        <div v-if="form.errors.price">
          {{ form.errors.price }}
        </div>
      </div>
  
      <div class="col-span-6">
        <button type="submit" class="btn-primary">Create</button>
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