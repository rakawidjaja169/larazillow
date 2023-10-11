<template>
  <form class="w-full" @submit.prevent="login">
    <div class="mx-auto md:w-1/2">
      <div class="relative z-0 w-full mb-6 group col-span-4">
        <input id="email" v-model="form.email" type="text" name="email" class="input peer" placeholder=" " />
        <label for="email" class="label">E-mail</label>
        <div v-if="form.errors.email" class="input-error">
          {{ form.errors.email }}
        </div>
      </div>

      <div class="relative z-0 w-full mb-6 group col-span-4">
        <input id="password" v-model="form.password" type="password" name="password" class="input peer" placeholder=" " />
        <label for="password" class="label">Password</label>
        <div v-if="form.errors.password" class="input-error">
          {{ form.errors.password }}
        </div>
      </div>

      <div class="mt-4">
        <button class="btn-primary w-full" type="submit">Login</button>
      </div>

      <Box class="md:col-span-7 flex items-center">
        <div class="w-full text-center font-medium text-gray-500">Forgot password?</div>
      </Box>

      <Box class="md:col-span-7 flex items-center">
        <div class="w-full text-center font-medium text-gray-500">
          Sign-In using 
          <a :href="route('auth.google')">Google</a>
        </div>
      </Box>
      
      <Box class="md:col-span-7 flex items-center">
        <div class="w-full text-center font-medium text-gray-500">
          Don't have an account? 
          <Link :href="route('register')">Sign-Up</Link>
        </div>
      </Box>
    </div>
  </form>
</template>
  
<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import Box from '@/Components/UI/Box.vue'

const form = useForm({
  email: null,
  password: null,
})

const login = () => form.post(route('login.store'))
</script>