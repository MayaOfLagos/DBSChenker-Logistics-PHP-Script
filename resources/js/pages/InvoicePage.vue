<template>
  <div class="min-h-screen bg-slate-100 text-slate-900">
    <header class="border-b border-slate-200 bg-white/95 shadow-sm no-print">
      <div class="mx-auto grid max-w-7xl grid-cols-[1fr_auto_1fr] items-center gap-4 px-4 py-4 sm:px-6 lg:px-8">
        <router-link :to="resultLink" class="inline-flex items-center gap-2 justify-self-start text-sm font-semibold text-slate-600 transition hover:text-red-600">
          <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7" />
          </svg>
          Back
        </router-link>

        <div class="flex items-center justify-center gap-3 justify-self-center">
          <img v-if="settings.logo_light_url || settings.logo_url" :src="settings.logo_light_url || settings.logo_url" :alt="brandName" class="h-10 max-w-[12rem] object-contain">
          <span v-else class="text-sm font-bold text-slate-950">{{ brandName }}</span>
        </div>

        <button type="button" @click="printInvoice" class="justify-self-end rounded-lg bg-red-600 px-4 py-2 text-sm font-bold text-white shadow-sm transition hover:bg-red-700">
          Print
        </button>
      </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
      <div v-if="loading" class="flex min-h-[50vh] flex-col items-center justify-center rounded-lg bg-white p-8 shadow-sm">
        <svg class="h-10 w-10 animate-spin text-red-600" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
        </svg>
        <p class="mt-4 text-sm font-medium text-slate-500">Preparing invoice...</p>
      </div>

      <section v-else-if="courier" class="overflow-hidden rounded-lg bg-white shadow-xl ring-1 ring-slate-200">
        <div class="relative overflow-hidden bg-slate-950 px-6 py-7 text-white sm:px-8">
          <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(239,68,68,0.32),_transparent_35%),linear-gradient(135deg,_rgba(15,23,42,1),_rgba(30,41,59,0.98))]"></div>
          <img :src="stampDutyImage" alt="" class="absolute right-8 top-6 h-32 w-32 rotate-[-12deg] object-contain opacity-15">

          <div class="relative grid gap-6 lg:grid-cols-[1fr_auto]">
            <div>
              <p class="text-xs font-bold uppercase tracking-[0.2em] text-red-200">Certified Shipment Invoice</p>
              <h1 class="mt-3 text-3xl font-black tracking-tight sm:text-4xl">{{ brandName }}</h1>
              <p class="mt-2 max-w-2xl text-sm leading-6 text-white/70">
                Official logistics invoice generated for tracking number
                <span class="font-mono font-bold text-white">{{ courier.trackingnumber }}</span>.
              </p>
            </div>

          </div>
        </div>

        <div class="grid gap-6 border-b border-slate-200 p-6 sm:p-8 lg:grid-cols-[1fr_auto]">
          <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <InfoCard title="Sender" :items="senderInfo" />
            <InfoCard title="Consignee" :items="receiverInfo" />
            <InfoCard title="Origin Office" :items="originInfo" />
            <InfoCard title="Destination Office" :items="destinationInfo" />
          </div>

          <div class="flex flex-col items-center justify-center rounded-lg border border-slate-200 bg-slate-50 p-4">
            <img :src="barcodeUrl" :alt="courier.trackingnumber" class="h-16 max-w-full object-contain">
            <p class="mt-3 font-mono text-xs font-bold tracking-widest text-slate-700">{{ courier.trackingnumber }}</p>
          </div>
        </div>

        <div class="grid gap-6 p-6 sm:p-8 xl:grid-cols-[1.35fr_0.85fr]">
          <div class="space-y-6">
            <section class="overflow-hidden rounded-lg border border-slate-200">
              <SectionTitle title="Parcel Details & Costs" />
              <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                  <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                    <tr>
                      <th class="px-4 py-3 text-left font-bold">Qty</th>
                      <th class="px-4 py-3 text-left font-bold">Product</th>
                      <th class="px-4 py-3 text-left font-bold">Status</th>
                      <th class="px-4 py-3 text-left font-bold">Description</th>
                      <th class="px-4 py-3 text-left font-bold">Shipping</th>
                      <th class="px-4 py-3 text-left font-bold">Clearance</th>
                    </tr>
                  </thead>
                  <tbody class="divide-y divide-slate-200">
                    <tr>
                      <td class="px-4 py-4 font-semibold">{{ courier.qty || 'N/A' }}</td>
                      <td class="px-4 py-4">Parcel</td>
                      <td class="px-4 py-4">
                        <span :class="statusPillClass(courier.status)" class="rounded-full px-2.5 py-1 text-xs font-bold">
                          {{ courier.status || 'In Processing' }}
                        </span>
                      </td>
                      <td class="px-4 py-4">{{ courier.description || 'Shipment parcel' }}</td>
                      <td class="px-4 py-4">{{ currency }}{{ fmt(shippingCost) }}</td>
                      <td class="px-4 py-4">{{ currency }}{{ fmt(clearanceCost) }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </section>

            <section class="grid gap-4 md:grid-cols-3">
              <StampCard title="Payment Methods" :image="securePaymentImage" note="Reliable, fast and secure payment processing." image-class="h-10" />
              <StampCard title="Official Stamp" :image="officialStampImage" :note="formatDateTime(courier.created_at)" image-class="h-20" />
              <StampCard title="Stamp Duty" :image="stampDutyImage" note="Verified & approved" image-class="h-20" />
            </section>
          </div>

          <aside class="space-y-6">
            <section class="overflow-hidden rounded-lg border border-slate-200 bg-white">
              <div class="bg-red-600 px-5 py-4 text-white">
                <h2 class="text-lg font-black">Payment Summary</h2>
              </div>
              <dl class="space-y-4 p-5 text-sm">
                <SummaryRow label="Shipment Cost" :value="`${currency}${fmt(shippingCost)}`" />
                <SummaryRow label="Clearance Cost" :value="`${currency}${fmt(clearanceCost)}`" />
                <SummaryRow label="Booking Mode" value="ToPay" />
              </dl>
            </section>

            <section class="rounded-lg border border-slate-200 bg-slate-50 p-5">
              <h2 class="text-sm font-black text-slate-950">Digital Verification</h2>
              <p class="mt-2 text-sm leading-6 text-slate-600">
                This invoice is linked to the live tracking record and can be verified using the tracking number.
              </p>
              <router-link :to="resultLink" class="mt-4 inline-flex text-sm font-bold text-red-600 hover:text-red-700">
                Open live tracking result
              </router-link>
            </section>
          </aside>
        </div>
      </section>

      <div v-else class="rounded-lg bg-white p-10 text-center shadow-sm ring-1 ring-slate-200">
        <h2 class="text-xl font-bold text-slate-800">Shipment record not found</h2>
        <p class="mt-2 text-slate-500">We could not prepare the invoice for this shipment.</p>
        <router-link :to="{ name: 'track' }" class="btn-primary mt-6">Back to Tracking</router-link>
      </div>
    </main>
  </div>
</template>

<script setup>
import { computed, defineComponent, h, onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'
import { toast } from '@steveyuowo/vue-hot-toast'
import { getInvoice, getSettings } from '../api/index.js'

const route = useRoute()
const loading = ref(true)
const settings = ref({ currency: '$', s_currency: '$' })
const courier = ref(null)
const summary = ref({})
const securePaymentImage = '/temp/securepayment.png'
const officialStampImage = '/temp/stamp1.png'
const stampDutyImage = '/temp/stamp2.png'

const brandName = computed(() => settings.value.site_name || 'Logistics')
const currency = computed(() => summary.value.currency || settings.value.s_currency || settings.value.currency || '$')
const shippingCost = computed(() => Number(summary.value.shipping_cost ?? courier.value?.cost ?? 0))
const clearanceCost = computed(() => Number(summary.value.clearance_cost ?? courier.value?.clearance_cost ?? 0))
const totalDue = computed(() => Number(summary.value.total_due ?? (shippingCost.value + clearanceCost.value)))
const barcodeUrl = computed(() => `https://barcode.tec-it.com/barcode.ashx?data=${encodeURIComponent(courier.value?.trackingnumber || '')}&code=Code128`)
const resultLink = computed(() => ({ name: 'result', query: { tracking: courier.value?.trackingnumber || '' } }))

const senderInfo = computed(() => [
  { label: 'Name', value: courier.value?.sname },
  { label: 'Address', value: courier.value?.saddress },
  { label: 'Email', value: courier.value?.semail },
])

const receiverInfo = computed(() => [
  { label: 'Name', value: courier.value?.name },
  { label: 'Address', value: courier.value?.address },
  { label: 'Phone', value: courier.value?.phone },
])

const originInfo = computed(() => [
  { label: 'Office', value: courier.value?.take_off_point },
  { label: 'Shipped', value: formatDate(courier.value?.date_shipped) },
  { label: 'Freight Type', value: courier.value?.freight_type },
])

const destinationInfo = computed(() => [
  { label: 'Office', value: courier.value?.final_destination },
  { label: 'Expected', value: formatDate(courier.value?.expected_delivery) },
  { label: 'Weight', value: weightLabel(courier.value?.weight) },
])

const InfoCard = defineComponent({
  props: {
    title: { type: String, required: true },
    items: { type: Array, required: true },
  },
  setup(props) {
    return () => h('article', { class: 'rounded-lg border border-slate-200 bg-white p-4 shadow-sm' }, [
      h('h2', { class: 'mb-3 text-sm font-black text-red-600' }, props.title),
      h('dl', { class: 'space-y-3' }, props.items.map((item) => h('div', { class: 'text-sm' }, [
        h('dt', { class: 'text-xs font-bold text-slate-400' }, item.label),
        h('dd', { class: 'mt-1 break-words font-semibold text-slate-800' }, item.value || 'N/A'),
      ]))),
    ])
  },
})

const SectionTitle = defineComponent({
  props: {
    title: { type: String, required: true },
  },
  setup(props) {
    return () => h('div', { class: 'border-b border-slate-200 bg-slate-50 px-5 py-4' }, [
      h('h2', { class: 'text-base font-black text-slate-950' }, props.title),
    ])
  },
})

const SummaryRow = defineComponent({
  props: {
    label: { type: String, required: true },
    value: { type: String, required: true },
  },
  setup(props) {
    return () => h('div', { class: 'flex items-center justify-between border-b border-slate-100 pb-3 last:border-b-0' }, [
      h('dt', { class: 'text-slate-500' }, props.label),
      h('dd', { class: 'font-bold text-slate-900' }, props.value),
    ])
  },
})

const StampCard = defineComponent({
  props: {
    title: { type: String, required: true },
    image: { type: String, required: true },
    note: { type: String, default: '' },
    imageClass: { type: String, default: 'h-16' },
  },
  setup(props) {
    return () => h('article', { class: 'rounded-lg border border-slate-200 bg-white p-4 shadow-sm' }, [
      h('h3', { class: 'text-sm font-black text-slate-800' }, props.title),
      h('div', { class: 'mt-3 flex h-24 items-center justify-center rounded-lg bg-slate-50 p-3' }, [
        h('img', { src: props.image, alt: props.title, class: `${props.imageClass} max-w-full object-contain` }),
      ]),
      props.note ? h('p', { class: 'mt-2 text-center text-xs font-medium text-slate-500' }, props.note) : null,
    ])
  },
})

onMounted(async () => {
  try {
    const { data } = await getSettings()
    settings.value = data
  } catch {}

  try {
    const { data } = await getInvoice(route.params.id)
    courier.value = data.courier
    summary.value = data.summary || {}
    settings.value = { ...settings.value, ...(data.settings || {}) }
  } catch {
    toast.error('Unable to load the invoice.')
  }

  loading.value = false
})

function statusPillClass(status) {
  const normalized = String(status || '').toLowerCase()
  if (normalized === 'delivered') return 'bg-emerald-100 text-emerald-800'
  if (normalized.includes('hold') || normalized.includes('custom')) return 'bg-amber-100 text-amber-800'
  return 'bg-blue-100 text-blue-800'
}

function weightLabel(value) {
  if (!value) return 'N/A'
  return String(value).toLowerCase().includes('kg') ? value : `${value} kg`
}

function fmt(value) {
  return Number(value || 0).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
}

function formatDate(value) {
  if (!value) return 'N/A'
  return new Date(value).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })
}

function formatDateTime(value) {
  if (!value) return 'N/A'
  return new Date(value).toLocaleString('en-US', {
    month: 'short',
    day: 'numeric',
    year: 'numeric',
    hour: 'numeric',
    minute: '2-digit',
  })
}

function printInvoice() {
  window.open(`/printinvoice/${route.params.id}`, '_blank', 'noopener')
}
</script>
