<template>
  <div class="min-h-screen bg-gray-50">
    <header class="bg-white border-b shadow-sm no-print">
      <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
        <button @click="$router.back()" class="flex items-center gap-2 text-gray-600 hover:text-red-600 transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
          Back
        </button>
        <span class="font-bold text-gray-900">{{ settings.site_name }}</span>
      </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-10">
      <div class="mb-8 text-center">
        <h1 class="text-2xl font-bold text-gray-900 mb-1">Shipment Clearance Payment</h1>
        <p class="text-gray-500 text-sm">Select a payment method and complete your details below</p>
      </div>

      <!-- Shipment context strip -->
      <div v-if="invoice" class="mb-6 rounded-xl border border-blue-200 bg-blue-50 p-4">
        <div class="flex flex-wrap items-start justify-between gap-3">
          <div>
            <p class="text-sm font-semibold text-blue-900">Clearance payment for your shipment</p>
            <p class="text-xs text-blue-700 mt-0.5 font-mono uppercase tracking-wide">{{ form.tracking }}</p>
          </div>
          <div class="text-right space-y-0.5">
            <p class="text-xs text-blue-700">Shipping: <span class="font-medium">{{ currency }}{{ fmt(invoice.summary.shipping_cost) }}</span></p>
            <p class="text-xs text-blue-700">Clearance: <span class="font-medium">{{ currency }}{{ fmt(invoice.summary.clearance_cost) }}</span></p>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form -->
        <div class="lg:col-span-2 card p-8">
          <form @submit.prevent="submit">
            <!-- Payment method selection -->
            <div class="mb-6">
              <label class="block text-sm font-semibold text-gray-700 mb-3">Payment Method</label>
              <div v-if="loadingMethods" class="text-gray-400 text-sm text-center py-4">Loading methods...</div>
              <div v-else class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                <label v-for="m in methods" :key="m.id"
                       :class="form.payment_method === m.name ? 'border-red-500 bg-red-50 ring-2 ring-red-300' : 'border-gray-200 hover:border-gray-300'"
                       class="flex flex-col items-center gap-2 p-4 rounded-xl border-2 cursor-pointer transition-all">
                  <input type="radio" :value="m.name" v-model="form.payment_method" class="sr-only">
                  <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                  </div>
                  <span class="text-xs font-medium text-gray-700 text-center">{{ m.name }}</span>
                </label>
              </div>
            </div>

            <!-- Method fee / limits callout -->
            <div v-if="selectedMethod" class="mb-5 rounded-lg bg-amber-50 border border-amber-200 p-3 text-sm space-y-1">
              <p class="font-semibold text-amber-800">{{ selectedMethod.name }} details</p>
              <div class="flex flex-wrap gap-x-4 gap-y-1 text-amber-700 text-xs">
                <span v-if="selectedMethod.minimum">Min: {{ currency }}{{ fmt(selectedMethod.minimum) }}</span>
                <span v-if="selectedMethod.maximum">Max: {{ currency }}{{ fmt(selectedMethod.maximum) }}</span>
                <span v-if="Number(selectedMethod.charges_fixed) > 0">Fixed fee: {{ currency }}{{ fmt(selectedMethod.charges_fixed) }}</span>
                <span v-if="Number(selectedMethod.charges_percentage) > 0">Fee: {{ selectedMethod.charges_percentage }}%</span>
                <span v-if="selectedMethod.duration">Processing: {{ selectedMethod.duration }}</span>
              </div>
            </div>

            <!-- Amount -->
            <div class="mb-5">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Amount ({{ currency }})</label>
              <div v-if="invoice" class="input-field bg-gray-50 flex items-center gap-1 select-none cursor-not-allowed">
                <span class="text-gray-500 font-medium">{{ currency }}</span>
                <span class="font-semibold text-gray-800">{{ fmt(form.amount) }}</span>
              </div>
              <p v-if="invoice" class="text-xs text-gray-400 mt-1">Amount is fixed based on your shipment invoice</p>
              <div v-else class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">{{ currency }}</span>
                <input v-model="form.amount" type="number" step="0.01" min="1"
                       class="input-field pl-8" placeholder="0.00" required>
              </div>
            </div>

            <!-- Name -->
            <div class="mb-5">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
              <input v-model="form.name" type="text" class="input-field" placeholder="Enter your full name" required>
            </div>

            <!-- Email -->
            <div class="mb-5">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
              <input v-model="form.email" type="email" class="input-field" placeholder="you@example.com" required>
            </div>

            <input type="hidden" v-model="form.tracking">

            <button type="submit" class="btn-primary w-full py-4 text-base mt-2" :disabled="loading || !form.payment_method">
              <svg v-if="loading" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
              </svg>
              {{ loading ? 'Processing...' : 'Continue to Payment' }}
            </button>
          </form>
        </div>

        <!-- Order summary sidebar -->
        <aside class="card p-6 h-fit space-y-4">
          <h2 class="font-bold text-gray-900">Payment Summary</h2>
          <div class="space-y-3 text-sm">
            <div class="flex justify-between">
              <span class="text-gray-500">Amount</span>
              <span class="font-semibold">{{ currency }}{{ fmt(form.amount || 0) }}</span>
            </div>
            <template v-if="selectedMethod">
              <div v-if="Number(selectedMethod.charges_fixed) > 0" class="flex justify-between">
                <span class="text-gray-500">Fixed fee</span>
                <span class="font-semibold">{{ currency }}{{ fmt(selectedMethod.charges_fixed) }}</span>
              </div>
              <div v-if="Number(selectedMethod.charges_percentage) > 0" class="flex justify-between">
                <span class="text-gray-500">Fee ({{ selectedMethod.charges_percentage }}%)</span>
                <span class="font-semibold">{{ currency }}{{ fmt(percentageFee) }}</span>
              </div>
            </template>
            <div v-if="form.tracking" class="flex justify-between pt-1">
              <span class="text-gray-500">Tracking</span>
              <span class="font-mono text-xs font-semibold uppercase tracking-wide">{{ form.tracking }}</span>
            </div>
            <div v-if="selectedMethod?.duration" class="flex justify-between">
              <span class="text-gray-500">Processing</span>
              <span class="font-semibold">{{ selectedMethod.duration }}</span>
            </div>
          </div>
          <div v-if="!form.payment_method" class="pt-2 text-xs text-gray-400">
            Select a payment method to see fees.
          </div>
        </aside>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { toast } from '@steveyuowo/vue-hot-toast'
import { getSettings, getPaymentMethods, createDeposit, getInvoice } from '../api/index.js'

const router = useRouter()
const route  = useRoute()

const settings       = ref({})
const methods        = ref([])
const loadingMethods = ref(true)
const loading        = ref(false)
const invoice        = ref(null)

const form = reactive({
  payment_method: '',
  amount: '',
  name: '',
  email: '',
  tracking: '',
  courier_id: '',
})

const currency = computed(() => settings.value?.currency || settings.value?.s_currency || '$')

const selectedMethod = computed(() => methods.value.find(m => m.name === form.payment_method) || null)

const percentageFee = computed(() => {
  const pct = Number(selectedMethod.value?.charges_percentage || 0)
  return (Number(form.amount || 0) * pct) / 100
})

const totalDue = computed(() => {
  const base = Number(form.amount || 0)
  const fixed = Number(selectedMethod.value?.charges_fixed || 0)
  return base + fixed + percentageFee.value
})

function fmt(value) {
  return Number(value || 0).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
}

onMounted(async () => {
  try { const { data } = await getSettings(); settings.value = data } catch {}

  if (route.query.courier_id) {
    try {
      const { data } = await getInvoice(route.query.courier_id)
      invoice.value = data
      form.amount     = Number(data.summary?.total_due || 0).toFixed(2)
      form.tracking   = data.courier?.trackingnumber || ''
      form.name       = data.courier?.name || ''
      form.email      = data.courier?.email || ''
      form.courier_id = data.courier?.id || route.query.courier_id
    } catch {}
  }

  try {
    const { data } = await getPaymentMethods()
    methods.value = data
  } catch {
    toast.error('Could not load payment methods. Please refresh.')
  } finally {
    loadingMethods.value = false
  }
})

async function submit() {
  if (!form.payment_method) {
    toast.error('Please select a payment method.')
    return
  }
  loading.value = true
  try {
    const { data } = await createDeposit({ ...form })
    sessionStorage.setItem('paymentSession', JSON.stringify(data))
    toast.success('Deposit details saved. Continue to payment.')
    router.push({ name: 'payment', query: { tracking: form.tracking || undefined }, state: { session: data } })
  } catch (e) {
    toast.error(e.response?.data?.message || 'Something went wrong. Please try again.')
  } finally {
    loading.value = false
  }
}
</script>
