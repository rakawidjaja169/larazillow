<template>
  <div class="w-full flex flex-col">
    <Link 
      v-if="permissions.includes('role-create')" 
      class="btn-primary w-40 mb-2 text-center"
      :href="route('role.create')"
    >
      <p>Create Role</p>
    </Link>
    <div class="w-3/4 m-auto relative overflow-x-auto shadow-md rounded-lg">
      <table class="w-full max-w-7xl text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-100 uppercase bg-sdh-thead dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">
              No
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
          <tr v-if="roles.length === 0" class="bg-white dark:bg-gray-800">
            <td colspan="7" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
              No Data
            </td>
          </tr>
          <tr
            v-for="(role, index) in roles"
            :key="role.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
          >
            <td class="w-4 p-4">
              {{ index + 1 }}
            </td>
            <td class="w-3/4 px-6 py-4">
              {{ role.name }}
            </td>
            <td class="flex items-center px-6 py-4 space-x-3">
              <Link :href="route('role.edit', { role: role.id })" as="button" class="btn-success">Edit</Link>
              <Link :href="route('role.destroy', { role: role.id })" as="button" method="DELETE" class="btn-danger">Delete</Link>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
  
<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const page = usePage()

const permissions = computed(
  () => page.props.user.permissions,
)

defineProps({
  roles: Object,
})

</script>