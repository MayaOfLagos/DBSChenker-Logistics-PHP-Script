<template>
  <div class="min-h-screen bg-slate-200 py-8 print:bg-white print:py-0">
    <div class="fixed right-4 top-4 z-50 no-print">
      <button type="button" @click="window.print()" class="rounded-lg bg-slate-950 px-4 py-2 text-sm font-bold text-white shadow-lg transition hover:bg-red-600">
        Print Invoice
      </button>
    </div>

    <main class="mx-auto max-w-5xl px-4 print:max-w-none print:p-0">
      <div v-if="loading" class="flex min-h-[60vh] items-center justify-center bg-white">
        <svg class="h-10 w-10 animate-spin text-red-600" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
        </svg>
      </div>

      <section v-else-if="courier" class="relative overflow-hidden bg-white p-8 shadow-2xl ring-1 ring-slate-200 print:min-h-screen print:p-8 print:shadow-none print:ring-0">
        <div class="pointer-events-none absolute inset-0 z-0 flex items-center justify-center opacity-[0.035]">
          <div class="-rotate-[28deg] text-center">
            <p class="text-[7rem] font-black leading-none text-slate-900">CERTIFIED</p>
            <p class="text-[5rem] font-black leading-none text-slate-900">TRUE COPY</p>
          </div>
        </div>

        <div class="relative z-10">
          <div class="grid grid-cols-[1fr_auto] gap-6 border-b-4 border-slate-950 pb-6">
            <div>
              <img v-if="settings.logo_url" :src="settings.logo_url" :alt="brandName" class="h-14 max-w-[14rem] object-contain">
              <h1 v-else class="text-2xl font-black text-slate-950">{{ brandName }}</h1>
              <p class="mt-3 text-sm font-semibold text-slate-600">{{ settings.site_address || 'International Shipping & Logistics Services' }}</p>
              <p class="text-sm text-slate-600">{{ settings.contact_email }}</p>
            </div>

            <div class="text-right">
              <p class="text-xs font-black uppercase tracking-[0.25em] text-red-600">Shipment Invoice</p>
              <p class="mt-3 font-mono text-xl font-black tracking-widest text-slate-950">{{ courier.trackingnumber }}</p>
              <p class="mt-1 text-sm text-slate-500">Generated {{ generatedAt }}</p>
            </div>
          </div>

          <div class="mt-6 grid gap-5 lg:grid-cols-[1fr_16rem]">
            <div class="grid gap-4 sm:grid-cols-2">
              <DocumentBlock title="From Sender" :items="senderInfo" />
              <DocumentBlock title="To Consignee" :items="receiverInfo" />
            </div>

            <div class="rounded-lg border border-slate-300 p-4 text-center">
              <img :src="barcodeUrl" :alt="courier.trackingnumber" class="mx-auto h-16 object-contain">
              <p class="mt-3 text-xs font-black uppercase tracking-widest text-slate-500">Barcode Verification</p>
              <p class="mt-1 font-mono text-sm font-bold text-slate-900">{{ courier.trackingnumber }}</p>
            </div>
          </div>

          <div class="mt-5 grid gap-4 sm:grid-cols-4">
            <MiniBox label="Order ID" :value="String(courier.id || 'N/A')" />
            <MiniBox label="Booking Mode" value="ToPay" />
            <MiniBox label="Freight Type" :value="courier.freight_type || 'N/A'" />
            <MiniBox label="Status" :value="courier.status || 'In Processing'" />
          </div>

          <div class="mt-6 overflow-hidden rounded-lg border border-slate-300">
            <table class="min-w-full text-sm">
              <thead class="bg-slate-950 text-white">
                <tr>
                  <th class="px-4 py-3 text-left font-black">Qty</th>
                  <th class="px-4 py-3 text-left font-black">Product</th>
                  <th class="px-4 py-3 text-left font-black">Description</th>
                  <th class="px-4 py-3 text-left font-black">Shipping Cost</th>
                  <th class="px-4 py-3 text-left font-black">Clearance Cost</th>
                  <th class="px-4 py-3 text-left font-black">Total Cost</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-b border-slate-200">
                  <td class="px-4 py-4 font-bold">{{ courier.qty || 'N/A' }}</td>
                  <td class="px-4 py-4">Parcel</td>
                  <td class="px-4 py-4">{{ courier.description || 'Shipment parcel' }}</td>
                  <td class="px-4 py-4">{{ currency }}{{ fmt(shippingCost) }}</td>
                  <td class="px-4 py-4">{{ currency }}{{ fmt(clearanceCost) }}</td>
                  <td class="px-4 py-4 font-black">{{ currency }}{{ fmt(totalDue) }}</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="mt-6 grid gap-6 lg:grid-cols-[1fr_20rem]">
            <div class="grid gap-4 sm:grid-cols-3">
              <PrintAsset title="Payment Methods" :image="securePaymentImage" note="Secure payment supported" image-class="h-10" />
              <PrintAsset title="Official Stamp" :image="officialStampImage" :note="formatDateTime(courier.created_at)" image-class="h-20" />
              <PrintAsset title="Stamp Duty" :image="stampDutyImage" note="Verified & approved" image-class="h-20" />
            </div>

            <section class="rounded-lg border-2 border-slate-950">
              <div class="bg-slate-950 px-5 py-3 text-white">
                <h2 class="text-base font-black">Amount Due</h2>
              </div>
              <dl class="space-y-3 p-5 text-sm">
                <MoneyRow label="Shipping Cost" :value="`${currency}${fmt(shippingCost)}`" />
                <MoneyRow label="Clearance Cost" :value="`${currency}${fmt(clearanceCost)}`" />
                <div class="border-t-2 border-slate-950 pt-3">
                  <div class="flex items-center justify-between gap-4">
                    <dt class="font-black text-slate-950">Total Amount</dt>
                    <dd class="text-2xl font-black text-red-600">{{ currency }}{{ fmt(totalDue) }}</dd>
                  </div>
                </div>
              </dl>
            </section>
          </div>

          <footer class="mt-8 border-t border-slate-200 pt-5 text-center">
            <p class="text-base font-black text-slate-950">Thank you for choosing {{ brandName }}</p>
            <p class="mt-1 text-sm text-slate-500">This document was generated from the live shipment record.</p>
          </footer>
        </div>
      </section>
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
const generatedAt = computed(() => new Date().toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' }))
const barcodeUrl = computed(() => `https://barcode.tec-it.com/barcode.ashx?data=${encodeURIComponent(courier.value?.trackingnumber || '')}&code=Code128`)

const senderInfo = computed(() => [
  { label: 'Name', value: courier.value?.sname },
  { label: 'Address', value: courier.value?.saddress },
  { label: 'Origin Office', value: courier.value?.take_off_point },
  { label: 'Email', value: courier.value?.semail },
])

const receiverInfo = computed(() => [
  { label: 'Name', value: courier.value?.name },
  { label: 'Phone', value: courier.value?.phone },
  { label: 'Address', value: courier.value?.address },
  { label: 'Destination Office', value: courier.value?.final_destination },
])

const DocumentBlock = defineComponent({
  props: {
    title: { type: String, required: true },
    items: { type: Array, required: true },
  },
  setup(props) {
    return () => h('article', { class: 'rounded-lg border border-slate-300 p-4' }, [
      h('h2', { class: 'mb-3 text-sm font-black uppercase tracking-wide text-red-600' }, props.title),
      h('dl', { class: 'space-y-2 text-sm' }, props.items.map((item) => h('div', {}, [
        h('dt', { class: 'text-xs font-bold uppercase text-slate-400' }, item.label),
        h('dd', { class: 'break-words font-semibold text-slate-900' }, item.value || 'N/A'),
      ]))),
    ])
  },
})

const MiniBox = defineComponent({
  props: {
    label: { type: String, required: true },
    value: { type: String, required: true },
  },
  setup(props) {
    return () => h('div', { class: 'rounded-lg border border-slate-300 bg-slate-50 p-3' }, [
      h('p', { class: 'text-xs font-bold uppercase text-slate-400' }, props.label),
      h('p', { class: 'mt-1 break-words text-sm font-black text-slate-950' }, props.value),
    ])
  },
})

const MoneyRow = defineComponent({
  props: {
    label: { type: String, required: true },
    value: { type: String, required: true },
  },
  setup(props) {
    return () => h('div', { class: 'flex items-center justify-between gap-4 border-b border-slate-200 pb-3' }, [
      h('dt', { class: 'text-slate-500' }, props.label),
      h('dd', { class: 'font-black text-slate-950' }, props.value),
    ])
  },
})

const PrintAsset = defineComponent({
  props: {
    title: { type: String, required: true },
    image: { type: String, required: true },
    note: { type: String, default: '' },
    imageClass: { type: String, default: 'h-16' },
  },
  setup(props) {
    return () => h('article', { class: 'rounded-lg border border-slate-300 p-4 text-center' }, [
      h('h3', { class: 'text-sm font-black text-slate-900' }, props.title),
      h('div', { class: 'mt-3 flex h-24 items-center justify-center rounded bg-slate-50 p-2' }, [
        h('img', { src: props.image, alt: props.title, class: `${props.imageClass} max-w-full object-contain` }),
      ]),
      props.note ? h('p', { class: 'mt-2 text-xs font-medium text-slate-500' }, props.note) : null,
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
    toast.error('Unable to load the printable invoice.')
  }

  loading.value = false
  window.setTimeout(() => {
    if (courier.value) window.print()
  }, 500)
})

function fmt(value) {
  return Number(value || 0).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })
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
</script>
