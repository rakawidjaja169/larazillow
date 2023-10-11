<template>
  <form class="w-full" @submit.prevent="update">
    <div class="grid grid-cols-6 gap-4">
      <div class="relative z-0 w-full mb-6 group col-span-6">
        <input id="name" v-model="form.name" type="text" name="name" class="input peer" placeholder=" " />
        <label for="name" class="label">Role Name</label>
        <div v-if="form.errors.name" class="input-error">
          {{ form.errors.name }}
        </div>
      </div>
    
      <div v-for="permission in permissions" :key="permission.id" class="col-span-6 flex items-center mb-4">
        <input 
          :id="'checkbox-permission-' + permission.id" 
          v-model="form.permissions" 
          type="checkbox" 
          :value="permission.id" 
          class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
        />
        <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ permission.name }}</label>
        <div v-if="form.errors.permission" class="input-error">
          {{ form.errors.permission }}
        </div>
      </div>
    
      <div class="col-span-6">
        <button type="submit" class="btn-primary">Edit</button>
      </div>
    </div>
  </form>
</template>
    
<script setup>
import { useForm } from '@inertiajs/vue3'
  
const props = defineProps({
  role: Object,
  permissions: Array,
  rule: Array,
})
  
const form = useForm({
  name: props.role.name,
  permissions: props.rule.map(permission => permission.id), // Initially select permissions based on the 'rule' array
})
  
const update = () => form.put(
  route('role.update', { role: props.role.id }),
)
</script>