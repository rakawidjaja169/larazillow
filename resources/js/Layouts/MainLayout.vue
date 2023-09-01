<template>
  <Disclosure v-slot="{ open }" as="nav" class="bg-gray-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 items-center justify-between">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button-->
          <DisclosureButton class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
            <span class="absolute -inset-0.5" />
            <span class="sr-only">Open main menu</span>
            <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
            <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
          </DisclosureButton>
          <Link :href="route('user.listing.create')" class="block md:hidden ml-5">
            <PlusCircleIcon class="block h-6 w-6" aria-hidden="true" />
          </Link>
        </div>
        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex flex-shrink-0 items-center">
            <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />
          </div>
          <div class="hidden sm:ml-6 sm:block">
            <div class="flex space-x-4">
              <Link v-for="item in navigation" :key="item.name" :href="item.href" :class="['text-gray-300 hover:bg-gray-700 hover:text-white', 'rounded-md px-3 py-2 text-sm font-medium']">{{ item.name }}</Link>
            </div>
          </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
          <Link :href="route('user.listing.create')" class="btn-primary mr-3 p-3 hidden md:block">+ Create Listing</Link>

          <button
            type="button"
            class="relative rounded-full bg-gray-800 p-3 mr-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
            @click="toggleDark()"
          >
            <span class="absolute -inset-1.5" />
            <span class="sr-only">{{ isDark ? 'Light Mode' : 'Dark Mode' }}</span>
            <template v-if="isDark">
              <SunIcon class="h-6 w-6" aria-hidden="true" />
            </template>
            <template v-else>
              <MoonIcon class="h-6 w-6" aria-hidden="true" />
            </template>
          </button>

          <button type="button" class="relative rounded-full bg-gray-800 p-3 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
            <span class="absolute -inset-1.5" />
            <span class="sr-only">View notifications</span>
            <BellIcon class="h-6 w-6" aria-hidden="true" />
            <span v-if="notificationCount" class="absolute top-0 right-0 bg-red-600 rounded-full w-6 h-6 text-white">
              {{ notificationCount }}
            </span>
          </button>

          <!-- Profile dropdown -->
          <Menu as="div" class="relative ml-3">
            <div v-if="user">
              <MenuButton 
                class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
              >
                <span class="absolute -inset-1.5" />
                <span class="sr-only">Open user menu</span>
                <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
              </MenuButton>
            </div>
            <div v-else>
              <Link :href="route('login')">Sign-In</Link>
            </div>
            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
              <MenuItems 
                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
              >
                <MenuItem v-slot="{ active, close }">
                  <Link 
                    :href="route('user.listing.index')" 
                    as="button" 
                    :class="[active ? 'bg-gray-100' : '', 'block text-sm text-gray-700 w-full']"
                  >
                    <button class="w-full px-4 py-2" @click="close">My Account</button>
                  </Link>
                </MenuItem>
                <MenuItem v-slot="{ active, close }">
                  <Link 
                    :href="route('logout')" 
                    method="delete" 
                    as="button" 
                    :class="[active ? 'bg-gray-100' : '', 'block text-sm text-gray-700 w-full']"
                  >
                    <button class="w-full px-4 py-2" @click="close">Sign out</button>
                  </Link>
                </MenuItem>
              </MenuItems>
            </transition>
          </Menu>
        </div>
      </div>
    </div>

    <DisclosurePanel class="sm:hidden">
      <div class="space-y-1 px-2 pb-3 pt-2">
        <Link v-for="item in navigation" :key="item.name" :href="item.href" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
          {{ item.name }}
        </Link>
      </div>
    </DisclosurePanel>
  </Disclosure>
  <main>
    <div class="container mx-auto p-4 flex flex-wrap justify-center">
      <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
        {{ flashSuccess }}
      </div>
      <slot>Default</slot>
    </div>
  </main>
</template>

<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { Bars3Icon, BellIcon, MoonIcon, SunIcon, XMarkIcon, PlusCircleIcon } from '@heroicons/vue/24/outline'
import { useDark, useToggle } from '@vueuse/core'

const isDark = useDark()
const toggleDark = useToggle(isDark)

const navigation = [
  { name: 'Dashboard', href: route('dashboard') },
  { name: 'Listings', href: route('listing.index') },
]

const page = usePage()
const flashSuccess = computed(
  () => page.props.flash.success,
)

const user = computed(
  () => page.props.user,
)

const notificationCount = computed(
  () => Math.min(page.props.user.notificationCount, 9),
)
// console.log('Current route:', route().current())
</script>