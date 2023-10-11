<template>
  <form class="w-full mx-auto" @submit.prevent="update">
    <div class="grid grid-cols-6 gap-4">
      <div class="relative z-0 w-full mb-6 group col-span-6">
        <input id="name" v-model="form.name" type="text" name="name" class="input peer" placeholder=" " />
        <label for="name" class="label">Name</label>
        <div v-if="form.errors.name" class="input-error">
          {{ form.errors.name }}
        </div>
      </div>

      <div class="relative z-0 w-full mb-6 group col-span-6">
        <input id="email" v-model="form.email" type="email" name="email" class="input peer" placeholder=" " />
        <label for="email" class="label">E-mail</label>
        <div v-if="form.errors.email" class="input-error">
          {{ form.errors.email }}
        </div>
      </div>

      <div class="relative z-0 w-full mb-6 group col-span-6">
        <input id="password" v-model="form.password" type="password" name="password" class="input peer" placeholder=" " />
        <label for="password" class="label">Password</label>
        <div v-if="form.errors.password" class="input-error">
          {{ form.errors.password }}
        </div>
      </div>

      <div class="relative z-0 w-full mb-6 group col-span-6">
        <input id="password_confirmation" v-model="form.password_confirmation" type="password" name="password_confirmation" class="input peer" placeholder=" " />
        <label for="password_confirmation" class="label">Confirm Password</label>
      </div>

      <div class="relative z-0 w-full mb-6 group col-span-6">
        <label for="role" class="label-select">Role</label>
        <select v-model="form.role" class="input-select">
          <option :value="null">Select Role</option>
          <option v-for="role in roles" :key="role.id" :value="role.id">
            {{ role.name }}
          </option>
        </select>
        <div
          v-if="form.errors.role"
          class="input-error"
        >
          {{ form.errors.role }}
        </div>
      </div>

      <div class="col-span-6">
        <button
          class="btn-primary"
          type="submit"
        >
          Edit Account
        </button>
      </div>
    </div>
  </form>
</template>
  
<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  user: Object,
  roles: Array,
  userRole: Object,
})

const form = useForm({
  name: props.user.name,
  email: props.user.email,
  password: null,
  password_confirmation: null,
  role: props.userRole[0].id,
})

const update = () => form.put(
  route('user-account.update', { user_account: props.user.id }),
)
</script>