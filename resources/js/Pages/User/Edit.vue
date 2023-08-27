<template>
  <form @submit.prevent="update">
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-4">
        <label class="label">Products</label>
        <input v-model="form.products" type="text" class="input" />
        <div v-if="form.errors.products" class="input-error">
          {{ form.errors.products }}
        </div>
      </div>
  
      <div class="col-span-2">
        <label class="label">Quantity</label>
        <input v-model.number="form.quantity" type="text" class="input" />
        <div v-if="form.errors.quantity" class="input-error">
          {{ form.errors.quantity }}
        </div>
      </div>
  
      <div class="col-span-6">
        <label class="label">Description</label>
        <input v-model="form.description" type="text" class="input" />
        <div v-if="form.errors.description" class="input-error">
          {{ form.errors.description }}
        </div>
      </div>
  
      <div class="col-span-6">
        <label class="label">Address</label>
        <input v-model="form.address" type="text" class="input" />
        <div v-if="form.errors.address" class="input-error">
          {{ form.errors.address }}
        </div>
      </div>
  
      <div class="col-span-6">
        <label class="label">Price</label>
        <input v-model.number="form.price" type="text" class="input" />
        <div v-if="form.errors.price" class="input-error">
          {{ form.errors.price }}
        </div>
      </div>
  
      <div class="col-span-6">
        <button type="submit" class="btn-primary">Edit</button>
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

const update = () => form.put(
  route('user.listing.update', { listing: props.listing.id }),
)
</script>