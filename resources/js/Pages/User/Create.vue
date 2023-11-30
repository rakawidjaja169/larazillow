<template>
  <form class="w-full" @submit.prevent="create">
    <div class="grid grid-cols-6 gap-4">
      <div class="relative z-0 w-full mb-6 group col-span-4">
        <input id="product" v-model="form.products" type="text" name="product" class="input peer" placeholder=" " />
        <label for="product" class="label">Products</label>
        <div v-if="form.errors.products" class="input-error">
          {{ form.errors.products }}
        </div>
      </div>

      <div class="relative z-0 w-full mb-6 group col-span-2">
        <input id="quantity" v-model="form.quantity" type="text" name="quantity" class="input peer" placeholder=" " />
        <label for="quantity" class="label">Quantity</label>
        <div v-if="form.errors.quantity" class="input-error">
          {{ form.errors.quantity }}
        </div>
      </div>

      <div class="relative z-0 w-full mb-6 group col-span-6">
        <input id="description" v-model="form.description" type="text" name="description" class="input peer" placeholder=" " />
        <label for="description" class="label">Description</label>
        <div v-if="form.errors.description" class="input-error">
          {{ form.errors.description }}
        </div>
      </div>

      <div class="relative z-0 w-full mb-6 group col-span-6">
        <input id="address" v-model="form.address" type="text" name="address" class="input peer" placeholder=" " />
        <label for="address" class="label">Address</label>
        <div v-if="form.errors.address" class="input-error">
          {{ form.errors.address }}
        </div>
      </div>

      <div class="relative z-0 w-full mb-6 group col-span-6">
        <input id="price" v-model="form.price" type="text" name="price" class="input peer" placeholder=" " />
        <label for="price" class="label">Price</label>
        <div v-if="form.errors.price" class="input-error">
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
import { useForm } from '@inertiajs/vue3'
const form = useForm({
  products: null,
  quantity: 0,
  description: null,
  address: null,
  price: 0,
})
const create = () => form.post(route('user.listing.store'))
</script>