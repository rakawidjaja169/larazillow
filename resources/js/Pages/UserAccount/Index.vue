<template>
  <div class="w-full flex flex-col">
    <Link 
      class="btn-primary w-40 mb-2 text-center" 
      :href="route('user-account.create')"
    >
      <p>Create User</p>
    </Link>
    <div class="w-3/4 m-auto relative overflow-x-auto shadow-md rounded-lg">
      <table class="w-full max-w-7xl text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-100 uppercase bg-sdh-thead dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="w-4 px-6 py-3">
              No
            </th>
            <th scope="col" class="px-6 py-3">
              User
            </th>
            <th scope="col" class="px-6 py-3">
              Role
            </th>
            <th scope="col" class="px-6 py-3">
              Action
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="users.length === 0" class="bg-white dark:bg-gray-800">
            <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
              No Data
            </td>
          </tr>
          <tr
            v-for="(user, index) in users"
            :key="user.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
          >
            <td class="p-4">
              {{ index + 1 }}
            </td>
            <td class="px-6 py-4">
              {{ user.name }}
            </td>
            <td class="px-6 py-4">
              <ul>
                <li v-for="role in user.roles" :key="role.id">{{ role.name }}</li>
              </ul>
            </td>
            <td class="flex items-center px-6 py-4 space-x-3">
              <Link :href="route('user-account.edit', { user_account: user.id })" as="button" class="btn-success">Edit</Link>
              <Link :href="route('user-account.destroy', { user_account: user.id })" as="button" method="DELETE" class="btn-danger">Delete</Link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
    
<script setup>
import { Link } from '@inertiajs/vue3'
  
defineProps({
  users: Object,
})
  
</script>