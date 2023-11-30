<template>
  <td class="px-6 py-4">
    <Price :price="monthlyPayment" />
  </td>
</template>

<script setup>
import Price from '@/Components/Price.vue'
import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'
import {ref} from 'vue'

const interestRate = ref(2.5)
const duration = ref(25)

const props = defineProps({
  listing: Object,
})

const { monthlyPayment } = useMonthlyPayment(props.listing.price, interestRate, duration)
</script>