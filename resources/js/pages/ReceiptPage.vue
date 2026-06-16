<template>
  <div class="min-h-screen bg-slate-100 text-slate-900">
    <header class="border-b border-slate-200 bg-white/95 shadow-sm no-print">
      <div class="mx-auto grid max-w-5xl grid-cols-[1fr_auto_1fr] items-center gap-4 px-4 py-4 sm:px-6 lg:px-8">
        <router-link :to="{ name: 'track' }" class="inline-flex items-center gap-2 justify-self-start text-sm font-semibold text-slate-600 transition hover:text-red-600">
          <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7" />
          </svg>
          Track
        </router-link>

        <div class="flex items-center justify-center justify-self-center">
          <img v-if="settings.logo_light_url || settings.logo_url" :src="settings.logo_light_url || settings.logo_url" :alt="brandName" class="h-10 max-w-[12rem] object-contain">
          <span v-else class="text-sm font-bold text-slate-950">{{ brandName }}</span>
        </div>

        <button v-if="receipt" type="button" @click="window.print()" class="justify-self-end rounded-lg bg-slate-950 px-4 py-2 text-sm font-bold text-white transition hover:bg-red-600">
          Print
        </button>
      </div>
    </header>

    <main class="mx-auto max-w-5xl px-4 py-8 sm:px-6 lg:px-8">
      <div v-if="loading" class="flex min-h-[50vh] flex-col items-center justify-center rounded-lg bg-white p-8 shadow-sm">
        <svg class="h-10 w-10 animate-spin text-red-600" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
        </svg>
        <p class="mt-4 text-sm font-medium text-slate-500">Loading payment receipt...</p>
      </div>

      <div v-else-if="receipt" class="space-y-6">
        <section class="relative overflow-hidden rounded-lg bg-white shadow-xl ring-1 ring-slate-200">
          <div class="absolute inset-0 flex items-center justify-center opacity-[0.025]">
            <div class="-rotate-[28deg] text-center">
              <p class="text-[7rem] font-black leading-none text-slate-950">OFFICIAL</p>
              <p class="text-[5rem] font-black leading-none text-slate-950">RECEIPT</p>
            </div>
          </div>

          <div class="relative">
            <div class="bg-gradient-to-r from-emerald-600 to-slate-950 px-6 py-7 text-white sm:px-8">
              <div class="flex flex-wrap items-start justify-between gap-5">
                <div>
                  <p class="text-xs font-bold uppercase tracking-[0.22em] text-emerald-100">Payment proof submitted</p>
                  <h1 class="mt-3 text-3xl font-black">Official Payment Receipt</h1>
                  <p class="mt-2 max-w-xl text-sm leading-6 text-white/70">
                    Your payment proof has been received and is pending verification by the finance team.
                  </p>
                </div>
                <div class="rounded-lg border border-white/15 bg-white/10 p-4 text-right backdrop-blur">
                  <p class="text-xs font-bold uppercase text-white/55">Amount Submitted</p>
                  <p class="mt-2 text-3xl font-black">{{ currency }}{{ fmt(receipt.deposit.amount) }}</p>
                  <span :class="statusPillClass(receipt.deposit.status)" class="mt-3 inline-flex rounded-full px-3 py-1 text-xs font-black">
                    {{ receipt.deposit.status || 'Pending' }}
                  </span>
                </div>
              </div>
            </div>

            <div class="grid gap-6 p-6 sm:p-8 lg:grid-cols-[1.15fr_0.85fr]">
              <section class="rounded-lg border border-slate-200 bg-white">
                <SectionHeader title="Payment Details" />
                <div class="grid gap-4 p-5 sm:grid-cols-2">
                  <DetailItem label="Transaction ID" :value="receipt.deposit.id" />
                  <DetailItem label="Submitted" :value="formatDate(receipt.deposit.created_at)" />
                  <DetailItem label="Payment Method" :value="receipt.payment_method_name" />
                  <DetailItem label="Tracking Number" :value="receipt.tracking_number || 'N/A'" />
                  <DetailItem label="Recipient" :value="receipt.deposit.guest_name || 'N/A'" />
                  <DetailItem label="Email" :value="receipt.deposit.guest_email || 'N/A'" />
                </div>
              </section>

              <section class="rounded-lg border border-slate-200 bg-slate-50 p-5">
                <h2 class="text-base font-black text-slate-950">Verification Status</h2>
                <div class="mt-5 space-y-4">
                  <StepItem active label="Proof received" note="Your upload has been attached to this transaction." />
                  <StepItem :active="isApproved" label="Finance review" note="The payment record is checked against the selected method." />
                  <StepItem :active="isApproved" label="Shipment clearance" note="Once approved, the clearance process can continue." />
                </div>
              </section>
            </div>
          </div>
        </section>

        <section v-if="courier" class="grid gap-6 lg:grid-cols-[1fr_18rem]">
          <div class="rounded-lg bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
              <div>
                <p class="text-xs font-bold uppercase tracking-wide text-red-600">Linked Shipment</p>
                <h2 class="mt-1 font-mono text-2xl font-black tracking-widest text-slate-950">{{ courier.trackingnumber }}</h2>
              </div>
              <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-black text-blue-800">{{ courier.status || 'In Processing' }}</span>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
              <DetailItem label="Sender" :value="courier.sname || 'N/A'" boxed />
              <DetailItem label="Receiver" :value="courier.name || 'N/A'" boxed />
              <DetailItem label="Origin" :value="courier.take_off_point || courier.saddress || 'N/A'" boxed />
              <DetailItem label="Destination" :value="courier.final_destination || courier.address || 'N/A'" boxed />
            </div>
          </div>

          <div class="rounded-lg bg-white p-5 shadow-sm ring-1 ring-slate-200">
            <h2 class="text-sm font-black text-slate-950">Shipment Amount</h2>
            <dl class="mt-4 space-y-3 text-sm">
              <MoneyLine label="Shipping" :value="`${shipmentCurrency}${fmt(shippingCost)}`" />
              <MoneyLine label="Clearance" :value="`${shipmentCurrency}${fmt(clearanceCost)}`" />
            </dl>
          </div>
        </section>

        <section class="grid gap-6 lg:grid-cols-2">
          <div class="rounded-lg bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
            <h2 class="font-black text-slate-950">What Happens Next?</h2>
            <ol class="mt-4 space-y-4 text-sm text-slate-600">
              <li class="flex gap-3">
                <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-red-100 text-xs font-black text-red-700">1</span>
                Our team verifies your payment proof, usually within 24 hours.
              </li>
              <li class="flex gap-3">
                <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-red-100 text-xs font-black text-red-700">2</span>
                Once confirmed, your shipment clearance process continues.
              </li>
              <li class="flex gap-3">
                <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-red-100 text-xs font-black text-red-700">3</span>
                You can track the shipment or open the invoice any time.
              </li>
            </ol>
          </div>

          <div class="rounded-lg bg-white p-5 shadow-sm ring-1 ring-slate-200 sm:p-6">
            <h2 class="font-black text-slate-950">Support</h2>
            <p class="mt-3 text-sm leading-6 text-slate-600">
              Questions about this payment can be sent to
              <a :href="`mailto:${settings.contact_email}`" class="font-bold text-red-600 hover:text-red-700">{{ settings.contact_email || 'support' }}</a>.
            </p>
            <div v-if="settings.whatsapp" class="mt-3">
              <a :href="`https://wa.me/${settings.whatsapp.replace(/\D/g, '')}`" target="_blank" rel="noopener"
                 class="inline-flex items-center gap-2 text-sm font-semibold text-emerald-600 hover:text-emerald-700">
                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/>
                </svg>
                Chat on WhatsApp
              </a>
            </div>
            <div class="mt-5 flex flex-wrap gap-3 no-print">
              <router-link :to="{ name: 'track' }" class="btn-primary">Track Another Shipment</router-link>
              <router-link v-if="receipt.deposit.courier_id" :to="{ name: 'invoice', params: { id: receipt.deposit.courier_id } }" class="btn-secondary">
                View Invoice
              </router-link>
            </div>
          </div>
        </section>
      </div>

      <div v-else class="rounded-lg bg-white p-10 text-center shadow-sm ring-1 ring-slate-200">
        <h2 class="text-xl font-bold text-slate-800">No receipt is available</h2>
        <p class="mt-2 text-slate-500">We could not find a payment receipt for this request.</p>
        <router-link :to="{ name: 'deposits' }" class="btn-primary mt-6">Go to Deposit Form</router-link>
      </div>
    </main>
  </div>
</template>

<script setup>
import { computed, defineComponent, h, onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import { toast } from '@steveyuowo/vue-hot-toast'
import { getSettings, getReceipt, getInvoice } from '../api/index.js'

const route = useRoute()
const loading = ref(true)
const settings = ref({ currency: '$', s_currency: '$' })
const receipt = ref(null)
const courier = ref(null)
const shipmentSummary = ref({})

const brandName = computed(() => settings.value.site_name || 'Logistics')
const currency = computed(() => receipt.value?.currency || settings.value.currency || '$')
const shipmentCurrency = computed(() => shipmentSummary.value.currency || settings.value.s_currency || settings.value.currency || '$')
const shippingCost = computed(() => Number(shipmentSummary.value.shipping_cost ?? courier.value?.cost ?? 0))
const clearanceCost = computed(() => Number(shipmentSummary.value.clearance_cost ?? courier.value?.clearance_cost ?? 0))
const totalDue = computed(() => Number(shipmentSummary.value.total_due ?? (shippingCost.value + clearanceCost.value)))
const isApproved = computed(() => String(receipt.value?.deposit?.status || '').toLowerCase().includes('approved'))

const SectionHeader = defineComponent({
  props: {
    title: { type: String, required: true },
  },
  setup(props) {
    return () => h('div', { class: 'border-b border-slate-200 bg-slate-50 px-5 py-4' }, [
      h('h2', { class: 'text-base font-black text-slate-950' }, props.title),
    ])
  },
})

const DetailItem = defineComponent({
  props: {
    label: { type: String, required: true },
    value: { type: [String, Number], default: 'N/A' },
    boxed: { type: Boolean, default: false },
  },
  setup(props) {
    return () => h('div', { class: props.boxed ? 'rounded-lg border border-slate-200 bg-slate-50 p-4' : '' }, [
      h('p', { class: 'text-xs font-bold uppercase tracking-wide text-slate-400' }, props.label),
      h('p', { class: 'mt-1 break-words font-bold text-slate-900' }, props.value || 'N/A'),
    ])
  },
})

const StepItem = defineComponent({
  props: {
    active: { type: Boolean, default: false },
    label: { type: String, required: true },
    note: { type: String, required: true },
  },
  setup(props) {
    return () => h('div', { class: 'flex gap-3' }, [
      h('span', { class: `mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full text-xs font-black ${props.active ? 'bg-emerald-600 text-white' : 'bg-slate-200 text-slate-500'}` }, props.active ? '✓' : ''),
      h('div', {}, [
        h('p', { class: 'font-black text-slate-950' }, props.label),
        h('p', { class: 'mt-1 text-sm leading-5 text-slate-500' }, props.note),
      ]),
    ])
  },
})

const MoneyLine = defineComponent({
  props: {
    label: { type: String, required: true },
    value: { type: String, required: true },
    strong: { type: Boolean, default: false },
  },
  setup(props) {
    return () => h('div', { class: 'flex items-center justify-between gap-3' }, [
      h('dt', { class: props.strong ? 'font-black text-slate-950' : 'text-slate-500' }, props.label),
      h('dd', { class: props.strong ? 'text-xl font-black text-red-600' : 'font-bold text-slate-950' }, props.value),
    ])
  },
})

onMounted(async () => {
  try {
    const { data } = await getSettings()
    settings.value = data
  } catch {}

  const receiptId = route.params.id || sessionStorage.getItem('lastReceiptId')
  const cached = sessionStorage.getItem('lastReceipt')

  if (cached && !route.params.id) {
    try {
      receipt.value = JSON.parse(cached)
      settings.value = { ...settings.value, ...(receipt.value.settings || {}) }
      await loadLinkedShipment()
      loading.value = false
      return
    } catch {}
  }

  if (!receiptId) {
    toast.error('No receipt is available.')
    loading.value = false
    return
  }

  try {
    const { data } = await getReceipt(receiptId)
    receipt.value = data
    settings.value = { ...settings.value, ...(data.settings || {}) }
    await loadLinkedShipment()
  } catch {
    toast.error('Unable to load the receipt.')
  }

  loading.value = false
})

async function loadLinkedShipment() {
  const courierId = receipt.value?.deposit?.courier_id
  if (!courierId) return

  try {
    const { data } = await getInvoice(courierId)
    courier.value = data.courier
    shipmentSummary.value = data.summary || {}
  } catch {}
}

function statusPillClass(status) {
  const normalized = String(status || '').toLowerCase()
  if (normalized.includes('approved') || normalized.includes('success')) return 'bg-emerald-300 text-emerald-950'
  if (normalized.includes('declined') || normalized.includes('failed')) return 'bg-red-300 text-red-950'
  return 'bg-amber-300 text-amber-950'
}

function fmt(value) {
  return Number(value || 0).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
}

function formatDate(value) {
  if (!value) return 'N/A'
  return new Date(value).toLocaleString('en-US', {
    month: 'short',
    day: 'numeric',
    year: 'numeric',
    hour: 'numeric',
    minute: '2-digit',
  })
}
</script>
