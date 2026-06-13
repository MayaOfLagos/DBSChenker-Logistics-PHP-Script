<template>
  <div class="min-h-screen bg-gray-50">
    <header class="bg-white border-b shadow-sm no-print">
      <div class="max-w-4xl mx-auto px-4 py-4 flex items-center justify-between">
        <router-link :to="{ name: 'deposits' }" class="flex items-center gap-2 text-gray-600 hover:text-red-600 transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
          Back
        </router-link>
        <span class="font-bold text-gray-900">{{ settings.site_name || 'Logistics' }}</span>
      </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-10">
      <div class="mb-8 text-center">
        <h1 class="text-2xl font-bold text-gray-900 mb-1">Complete Payment</h1>
        <p class="text-gray-500 text-sm">Upload your proof so we can verify the deposit</p>
      </div>

      <div v-if="!sessionData" class="card p-8 text-center">
        <p class="text-gray-600 mb-4">Your payment session is missing.</p>
        <router-link :to="{ name: 'deposits' }" class="btn-primary">Return to Deposit Form</router-link>
      </div>

      <div v-else class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 card p-8">
          <form @submit.prevent="submit">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                <input v-model="form.name" type="text" class="input-field" required>
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                <input v-model="form.email" type="email" class="input-field" required>
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Amount</label>
                <input v-model="form.amount" type="number" step="0.01" min="1" class="input-field" required>
              </div>
              <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Payment Method</label>
                <input :value="sessionData.payment_method?.name" class="input-field bg-gray-100" readonly>
              </div>
            </div>

            <div class="mb-5">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Tracking Number</label>
              <input v-model="form.tracking" type="text" class="input-field uppercase" readonly>
            </div>

            <div class="mb-6">
              <label class="block text-sm font-semibold text-gray-700 mb-2">Payment Proof</label>
              <input type="file" accept="image/*" @change="onFileChange" class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-red-50 file:text-red-700 hover:file:bg-red-100">
              <p class="text-xs text-gray-400 mt-2">PNG, JPG, JPEG, or WEBP up to 2MB.</p>
            </div>

            <button type="submit" class="btn-primary w-full py-4 text-base" :disabled="loading">
              <svg v-if="loading" class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
              </svg>
              {{ loading ? 'Submitting...' : 'Submit Payment Proof' }}
            </button>
          </form>
        </div>

        <aside class="card p-8 space-y-4">
          <h2 class="font-bold text-gray-900">Payment Summary</h2>
          <div class="space-y-3 text-sm">
            <div class="flex justify-between">
              <span class="text-gray-500">Amount</span>
              <span class="font-semibold">{{ currency }}{{ fmt(form.amount) }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-500">Tracking</span>
              <span class="font-semibold">{{ form.tracking || '—' }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-500">Name</span>
              <span class="font-semibold text-right">{{ form.name || '—' }}</span>
            </div>
            <div class="flex justify-between">
              <span class="text-gray-500">Email</span>
              <span class="font-semibold text-right break-all">{{ form.email || '—' }}</span>
            </div>
          </div>

          <div class="pt-4 border-t border-gray-100">
            <p class="text-xs text-gray-500 leading-6">
              After submission you'll be taken directly to your official payment receipt. Verification typically takes up to 24 hours.
            </p>
          </div>
        </aside>
      </div>
    </main>
  </div>
</template>

<script setup>
import { computed, onMounted, reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import { toast } from '@steveyuowo/vue-hot-toast'
import { getSettings, submitPaymentProof } from '../api/index.js'

const router = useRouter()
const settings = ref({})
const sessionData = ref(null)
const loading = ref(false)
const proofFile = ref(null)

const form = reactive({
  amount: '',
  method: '',
  name: '',
  email: '',
  tracking: '',
  courier_id: '',
})

const currency = computed(() => settings.value?.currency || settings.value?.s_currency || '$')

onMounted(async () => {
  try {
    const { data } = await getSettings()
    settings.value = data
  } catch {}

  const raw = sessionStorage.getItem('paymentSession')
  if (raw) {
    try {
      sessionData.value = JSON.parse(raw)
      form.amount = sessionData.value.amount ?? ''
      form.method = sessionData.value.payment_method?.name ?? ''
      form.name = sessionData.value.name ?? ''
      form.email = sessionData.value.email ?? ''
      form.tracking = sessionData.value.tracking ?? ''
      form.courier_id = sessionData.value.courier_id ?? ''
    } catch {
      sessionData.value = null
    }
  }

  if (!sessionData.value) {
    toast.error('Your payment session is missing.')
  }
})

function onFileChange(event) {
  proofFile.value = event.target.files?.[0] || null
}

function fmt(value) {
  return Number(value || 0).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
}

async function submit() {
  if (!proofFile.value) {
    toast.error('Please upload a payment proof.')
    return
  }

  loading.value = true

  try {
    const payload = new FormData()
    payload.append('proof', proofFile.value)
    payload.append('amount', form.amount)
    payload.append('method', form.method)
    payload.append('email', form.email)
    payload.append('name', form.name)
    if (form.tracking) payload.append('tracking', form.tracking)
    if (form.courier_id) payload.append('courier_id', form.courier_id)

    const { data } = await submitPaymentProof(payload)
    sessionStorage.setItem('lastReceiptId', String(data.deposit.id))
    sessionStorage.setItem('lastReceipt', JSON.stringify(data))
    sessionStorage.removeItem('paymentSession')
    toast.success('Payment proof submitted successfully.')
    router.push({ name: 'receipt', params: { id: data.deposit.id } })
  } catch (error) {
    toast.error(error.response?.data?.message || 'Something went wrong while submitting your proof.')
  } finally {
    loading.value = false
  }
}
</script>
