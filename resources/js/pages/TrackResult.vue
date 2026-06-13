<template>
  <div :class="{ dark: isDark }">
    <div class="min-h-screen bg-slate-100 text-slate-900 transition-colors duration-300 dark:bg-slate-950 dark:text-slate-100">
    <header class="border-b border-slate-200 bg-white/95 shadow-sm no-print dark:border-slate-800 dark:bg-slate-950/95 dark:shadow-black/20">
      <div class="mx-auto grid max-w-7xl grid-cols-[1fr_auto_1fr] items-center gap-3 px-4 py-4 sm:px-6 lg:px-8">
        <router-link to="/" class="inline-flex items-center gap-2 justify-self-start text-sm font-semibold text-slate-600 transition hover:text-red-600 dark:text-slate-300 dark:hover:text-red-400">
          <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 19l-7-7 7-7" />
          </svg>
          <span class="hidden sm:inline">Track Another</span>
        </router-link>

        <div class="flex items-center justify-center gap-3 justify-self-center">
          <img
            v-if="settings.logo_url"
            :src="settings.logo_url"
            :alt="settings.site_name || 'Logistics'"
            class="h-9 w-auto max-w-[12rem] object-contain sm:h-10"
          >
          <span v-else class="text-sm font-bold text-slate-900 dark:text-white">{{ settings.site_name || 'Logistics' }}</span>
        </div>

        <button
          type="button"
          class="inline-flex h-10 w-10 items-center justify-center justify-self-end rounded-full text-slate-700 transition hover:bg-slate-100 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:text-slate-200 dark:hover:bg-slate-800 dark:hover:text-red-400 dark:focus:ring-offset-slate-950"
          :aria-label="isDark ? 'Switch to light mode' : 'Switch to dark mode'"
          :title="isDark ? 'Switch to light mode' : 'Switch to dark mode'"
          @click="toggleTheme"
        >
          <svg v-if="isDark" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.36-6.36-1.42 1.42M7.05 16.95l-1.41 1.41m12.72 0-1.42-1.41M7.05 7.05 5.64 5.64" />
            <circle cx="12" cy="12" r="4" stroke-width="1.8" />
          </svg>
          <svg v-else class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12.79A8.5 8.5 0 1 1 11.21 3 6.7 6.7 0 0 0 21 12.79z" />
          </svg>
        </button>
      </div>
    </header>

    <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <div v-if="loading" class="flex min-h-[50vh] flex-col items-center justify-center rounded-lg bg-white p-8 shadow-sm dark:bg-slate-900 dark:ring-1 dark:ring-slate-800">
        <svg class="h-10 w-10 animate-spin text-red-600" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
        </svg>
        <p class="mt-4 text-sm font-medium text-slate-500 dark:text-slate-400">Fetching shipment record...</p>
      </div>

      <template v-else-if="courier">
        <section class="relative mb-6 overflow-hidden rounded-lg bg-slate-950 shadow-xl">
          <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(239,68,68,0.28),_transparent_34%),linear-gradient(135deg,_rgba(15,23,42,1),_rgba(30,41,59,0.96))]"></div>
          <div class="relative grid gap-6 p-6 text-white lg:grid-cols-[1fr_auto] lg:p-8">
            <div>
              <div class="mb-3 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-3 py-1.5 text-xs font-semibold text-white/75">
                <span class="h-2 w-2 rounded-full bg-emerald-400"></span>
                Verified shipment
              </div>
              <p class="text-sm font-medium text-white/60">Tracking Number</p>
              <div class="mt-2 flex flex-wrap items-center gap-3">
                <h1 class="font-mono text-3xl font-bold tracking-widest text-white sm:text-4xl">{{ courier.trackingnumber }}</h1>
                <span :class="statusPillClass(courier.status, true)" class="rounded-full px-3 py-1 text-xs font-bold">
                  {{ courier.status || 'In Processing' }}
                </span>
              </div>
              <p class="mt-3 max-w-2xl text-sm leading-6 text-white/70">
                Last update {{ formatDateTime(lastUpdated) }}. Route progress is based on Laravel shipment history and admin status changes.
              </p>
            </div>

            <div class="relative flex min-w-[15rem] items-center justify-center">
              <img
                :src="stampImage"
                alt=""
                class="absolute right-1 top-1 h-28 w-28 rotate-[-10deg] object-contain opacity-35"
              >
              <div class="relative rounded-lg border border-white/15 bg-white/10 p-4 text-right backdrop-blur-md">
                <p class="text-xs font-semibold uppercase text-white/55">Total Due</p>
                <p class="mt-2 text-3xl font-bold">{{ currency }}{{ fmt(totalDue) }}</p>
                <p class="mt-1 text-xs text-white/55">Shipping + clearance</p>
              </div>
            </div>
          </div>
        </section>

        <section class="mb-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
          <InfoCard title="Sender Information" :items="senderInfo" />
          <InfoCard title="Receiver Information" :items="receiverInfo" />
          <InfoCard title="Shipment Details" :items="shipmentDetails" />
          <InfoCard title="Status Information" :items="statusInfo" />
        </section>

        <section class="mb-6 rounded-lg bg-white p-5 shadow-sm ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800 sm:p-6">
          <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
            <div>
              <h2 class="text-lg font-bold text-slate-950 dark:text-white">Shipment Progress</h2>
              <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ courier.percentage_complete || progressPercent }}% complete</p>
            </div>
            <div class="h-2 w-full rounded-full bg-slate-100 dark:bg-slate-800 md:w-72">
              <div class="h-2 rounded-full bg-red-600 transition-all duration-700" :style="{ width: `${courier.percentage_complete || progressPercent}%` }"></div>
            </div>
          </div>

          <div class="relative">
            <div class="absolute left-7 top-7 bottom-7 z-0 flex w-1 flex-col md:hidden">
              <div v-for="index in 4" :key="`mobile-${index}`" :class="progressSegmentClass(index)" class="min-h-10 flex-1"></div>
            </div>
            <div class="absolute left-8 right-8 top-8 z-0 hidden grid-cols-4 md:grid">
              <div v-for="index in 4" :key="`desktop-${index}`" :class="progressSegmentClass(index)" class="h-1"></div>
            </div>

            <div class="relative grid gap-6 md:grid-cols-5">
              <div v-for="step in progressSteps" :key="step.key" class="flex gap-4 md:block md:text-center">
                <div
                  :class="step.done ? step.activeClass : 'bg-slate-200 text-slate-400'"
                  class="relative z-10 flex h-14 w-14 shrink-0 items-center justify-center rounded-full border-4 border-white shadow-md dark:border-slate-900 md:mx-auto md:h-16 md:w-16"
                >
                  <component :is="step.icon" class="h-6 w-6" />
                </div>
                <div class="pt-1 md:mt-3 md:pt-0">
                  <h3 :class="step.done ? 'text-slate-950 dark:text-white' : 'text-slate-500 dark:text-slate-400'" class="text-sm font-bold">{{ step.label }}</h3>
                  <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ step.date ? formatDate(step.date) : 'Pending' }}</p>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="mb-6 grid gap-6 lg:grid-cols-[0.9fr_1.4fr]">
          <div class="rounded-lg bg-white shadow-sm ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
            <SectionHeader title="Shipment History" :meta="`${tracks.length} update(s)`" />
            <div class="p-5 sm:p-6">
              <div v-if="tracks.length" class="relative">
                <div class="absolute left-4 top-0 h-full w-0.5 bg-slate-200 dark:bg-slate-700"></div>
                <article v-for="track in tracks" :key="track.id" class="relative mb-6 flex gap-4 last:mb-0">
                  <div :class="timelineDotClass(track.status)" class="relative z-10 flex h-8 w-8 shrink-0 items-center justify-center rounded-full border-2 border-white text-white shadow dark:border-slate-900">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 2" />
                      <circle cx="12" cy="12" r="9" stroke-width="2" />
                    </svg>
                  </div>
                  <div class="min-w-0 flex-1 rounded-lg border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/70">
                    <div class="flex flex-wrap items-center justify-between gap-2">
                      <span :class="statusPillClass(track.status)" class="rounded-full px-2.5 py-1 text-xs font-bold">
                        {{ track.status || 'Update' }}
                      </span>
                      <span class="text-xs font-medium text-slate-400 dark:text-slate-500">{{ formatDateTime(track.created_at) }}</span>
                    </div>
                    <p class="mt-3 text-sm font-semibold text-slate-900 dark:text-slate-100">{{ placeLine(track) }}</p>
                    <p v-if="track.comment" class="mt-1 text-sm leading-6 text-slate-600 dark:text-slate-400">{{ track.comment }}</p>
                  </div>
                </article>
              </div>
              <div v-else class="rounded-lg border border-dashed border-slate-300 p-8 text-center text-sm text-slate-500 dark:border-slate-700 dark:text-slate-400">
                No shipment history available.
              </div>
            </div>
          </div>

          <div class="overflow-hidden rounded-lg bg-white shadow-sm ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
            <SectionHeader title="Complete Shipment Route" meta="OpenStreetMap" />
            <div class="relative h-[34rem] bg-slate-200 dark:bg-slate-950">
              <div ref="mapRef" class="h-full w-full"></div>
              <div class="absolute bottom-4 left-4 z-[500] max-w-sm rounded-lg bg-white/94 p-4 shadow-lg backdrop-blur dark:bg-slate-950/94 dark:ring-1 dark:ring-slate-800">
                <h3 class="text-sm font-bold text-slate-900 dark:text-white">Shipment Route</h3>
                <div class="mt-3 space-y-3 text-xs">
                  <RouteLine label="Origin Point" marker="A" color="bg-blue-600" :value="originAddress" />
                  <RouteLine label="Current Location" marker="B" color="bg-amber-500" :value="currentAddress" />
                  <RouteLine label="Destination" marker="C" color="bg-emerald-600" :value="destinationAddress" />
                </div>
                <a
                  :href="googleMapsUrl"
                  target="_blank"
                  rel="noopener"
                  class="mt-4 inline-flex items-center text-xs font-bold text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300"
                >
                  Open in Google Maps
                </a>
              </div>
            </div>
          </div>
        </section>

        <section class="mb-6 overflow-hidden rounded-lg bg-white shadow-sm ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
          <SectionHeader title="Parcel Information" />
          <div class="grid gap-6 p-5 sm:p-6 lg:grid-cols-[18rem_1fr]">
            <div v-if="parcelPhotoUrl" class="rounded-lg bg-slate-100 p-2 dark:bg-slate-950">
              <img :src="parcelPhotoUrl" alt="Parcel photo" class="aspect-[4/3] w-full rounded-lg object-cover">
            </div>
            <div v-else class="hidden rounded-lg border border-dashed border-slate-300 bg-slate-50 p-6 text-center text-sm text-slate-400 dark:border-slate-700 dark:bg-slate-950 lg:block">
              Parcel image not available
            </div>

            <div>
              <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                <MiniStat title="Duty Fees" :value="courier.cstatus || 'N/A'" />
                <MiniStat title="Weight" :value="weightLabel" />
                <MiniStat title="Pickup Date" :value="formatDateTime(courier.date_shipped)" />
                <MiniStat title="Expected Delivery" :value="formatDateTime(courier.expected_delivery)" />
                <MiniStat title="Delivery Mode" :value="courier.freight_type || 'N/A'" />
                <MiniStat title="Tracking Status" :value="courier.status || 'N/A'" />
              </div>

              <div class="mt-6 flex flex-wrap gap-3 no-print">
                <router-link :to="{ name: 'printinvoice', params: { id: courier.id } }" class="btn-secondary">
                  <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 9V3h12v6M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v7H6z" />
                  </svg>
                  Print Receipt
                </router-link>
                <router-link v-if="totalDue > 0" :to="{ name: 'deposits', query: { courier_id: courier.id } }" class="btn-primary bg-emerald-600 hover:bg-emerald-700 focus:ring-emerald-500">
                  <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                  </svg>
                  Pay Clearance Fee ({{ currency }}{{ fmt(totalDue) }})
                </router-link>
                <router-link :to="{ name: 'invoice', params: { id: courier.id } }" class="btn-secondary">
                  View Invoice
                </router-link>
              </div>

              <div v-if="settings.contact_email || settings.whatsapp" class="mt-4 flex flex-wrap items-center gap-4 border-t border-slate-100 pt-4 text-sm text-slate-500 dark:border-slate-800 no-print">
                <span>Need help?</span>
                <a v-if="settings.contact_email" :href="`mailto:${settings.contact_email}`"
                   class="inline-flex items-center gap-1.5 font-semibold text-slate-700 hover:text-red-600 dark:text-slate-300 dark:hover:text-red-400 transition-colors">
                  <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                  </svg>
                  {{ settings.contact_email }}
                </a>
                <a v-if="settings.whatsapp" :href="`https://wa.me/${settings.whatsapp.replace(/\D/g, '')}`" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-1.5 font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">
                  <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/>
                  </svg>
                  WhatsApp
                </a>
              </div>
            </div>
          </div>
        </section>
      </template>

      <div v-else-if="!loading" class="rounded-lg bg-white p-10 text-center shadow-sm ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
        <svg class="mx-auto mb-4 h-16 w-16 text-slate-300 dark:text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 0 1 5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z" />
        </svg>
        <h2 class="text-xl font-bold text-slate-700 dark:text-slate-100">No result found</h2>
        <p class="mt-2 text-slate-500 dark:text-slate-400">We could not find a shipment with that tracking number.</p>
        <router-link to="/" class="btn-primary mt-6">Try Again</router-link>
      </div>
    </main>
    </div>
  </div>
</template>

<script setup>
import { computed, defineComponent, h, nextTick, onBeforeUnmount, onMounted, ref } from 'vue'
import { toast } from '@steveyuowo/vue-hot-toast'
import L from 'leaflet'
import 'leaflet/dist/leaflet.css'
import { getSettings, trackShipment } from '../api/index.js'

const loading = ref(true)
const settings = ref({})
const courier = ref(null)
const tracks = ref([])
const summary = ref({})
const mapRef = ref(null)
const isDark = ref(false)
let mapInstance = null

const themeStorageKey = 'tracking-result-theme'
const statusOrder = ['Order Confirmed', 'Picked by Courier', 'On The Way', 'Custom Hold', 'Delivered']

const latestTrack = computed(() => tracks.value?.[0] || null)
const currency = computed(() => summary.value?.currency || settings.value?.s_currency || settings.value?.currency || '$')
const totalDue = computed(() => Number(summary.value?.total_due ?? ((+courier.value?.cost || 0) + (+courier.value?.clearance_cost || 0))))
const lastUpdated = computed(() => latestTrack.value?.created_at || courier.value?.updated_at || courier.value?.date_shipped)
const stampImage = computed(() => courier.value?.status === 'Delivered' ? '/temp/stamp1.png' : '/temp/stamp2.png')
const originAddress = computed(() => courier.value?.saddress || courier.value?.take_off_point || courier.value?.address || '')
const currentTrackPoint = computed(() => tracks.value.find((track) => clean(track.city) && clean(track.country)) || null)
const currentAddress = computed(() => {
  if (clean(courier.value?.take_off_point)) return clean(courier.value.take_off_point)

  if (currentTrackPoint.value) {
    return [clean(currentTrackPoint.value.city), clean(currentTrackPoint.value.country)].filter(Boolean).join(', ')
  }

  return [
    clean(courier.value?.location),
    clean(courier.value?.country) || clean(courier.value?.scountry),
  ].filter(Boolean).join(', ') || courier.value?.take_off_point || originAddress.value
})
const destinationAddress = computed(() => courier.value?.address || courier.value?.final_destination || courier.value?.saddress || '')
const progressPercent = computed(() => Math.round((completedSteps.value / statusOrder.length) * 100))
const completedSteps = computed(() => progressSteps.value.filter((step) => step.done).length)
const weightLabel = computed(() => {
  const weight = courier.value?.weight
  if (!weight) return 'N/A'
  return String(weight).toLowerCase().includes('kg') ? weight : `${weight} kg`
})
const parcelPhotoUrl = computed(() => {
  const photo = courier.value?.photo
  if (!photo) return ''
  if (/^https?:\/\//i.test(photo) || photo.startsWith('/')) return photo
  if (photo.startsWith('shipment_photos/')) return `/${photo}`
  return `/storage/${photo}`
})
const googleMapsUrl = computed(() => {
  const parts = [originAddress.value, currentAddress.value, destinationAddress.value].filter(Boolean).map(encodeURIComponent)
  return `https://www.google.com/maps/dir/${parts.join('/')}`
})

const senderInfo = computed(() => [
  { label: 'Name', value: courier.value?.sname },
  { label: 'Address', value: courier.value?.saddress },
  { label: 'Email', value: courier.value?.semail },
])

const receiverInfo = computed(() => [
  { label: 'Name', value: courier.value?.name },
  { label: 'Address', value: courier.value?.address },
  { label: 'Phone', value: courier.value?.phone },
  { label: 'Email', value: courier.value?.email },
])

const shipmentDetails = computed(() => [
  { label: 'Weight', value: weightLabel.value },
  { label: 'Type', value: courier.value?.freight_type },
  { label: 'Quantity', value: courier.value?.qty },
  { label: 'Shipped', value: formatDate(courier.value?.date_shipped) },
])

const statusInfo = computed(() => [
  { label: 'Status', value: courier.value?.status },
  { label: 'Location', value: courier.value?.location || latestTrack.value?.city },
  { label: 'Progress', value: `${courier.value?.percentage_complete || progressPercent.value}%` },
])

const progressSteps = computed(() => {
  return statusOrder.map((label, index) => {
    const track = findTrack(label)
    const isFirst = index === 0
    const done = isFirst || Boolean(track) || statusOrder.indexOf(courier.value?.status) >= index
    return {
      key: label,
      label,
      done,
      date: isFirst ? courier.value?.date_shipped : track?.created_at,
      activeClass: label === 'Custom Hold'
        ? 'bg-amber-500 text-white'
        : label === 'Delivered'
          ? 'bg-emerald-600 text-white'
          : 'bg-red-600 text-white',
      icon: stepIcon(label),
    }
  })
})

const SectionHeader = defineComponent({
  props: {
    title: { type: String, required: true },
    meta: { type: String, default: '' },
  },
  setup(props) {
    return () => h('div', { class: 'flex items-center justify-between gap-4 border-b border-slate-200 bg-slate-50 px-5 py-4 dark:border-slate-800 dark:bg-slate-950/70 sm:px-6' }, [
      h('h2', { class: 'text-lg font-bold text-slate-900 dark:text-white' }, props.title),
      props.meta ? h('span', { class: 'text-xs font-semibold text-slate-500 dark:text-slate-400' }, props.meta) : null,
    ])
  },
})

const InfoCard = defineComponent({
  props: {
    title: { type: String, required: true },
    items: { type: Array, required: true },
  },
  setup(props) {
    return () => h('article', { class: 'rounded-lg bg-white p-5 shadow-sm ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800' }, [
      h('h2', { class: 'mb-4 text-sm font-bold text-red-600' }, props.title),
      h('dl', { class: 'space-y-3' }, props.items.map((item) => h('div', { class: 'text-sm' }, [
        h('dt', { class: 'text-xs font-semibold text-slate-400 dark:text-slate-500' }, item.label),
        h('dd', { class: 'mt-1 break-words font-semibold text-slate-800 dark:text-slate-100' }, item.value || 'N/A'),
      ]))),
    ])
  },
})

const MiniStat = defineComponent({
  props: {
    title: { type: String, required: true },
    value: { type: [String, Number], default: 'N/A' },
  },
  setup(props) {
    return () => h('div', { class: 'rounded-lg border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/70' }, [
      h('p', { class: 'text-xs font-semibold text-slate-400 dark:text-slate-500' }, props.title),
      h('p', { class: 'mt-2 break-words text-sm font-bold text-slate-800 dark:text-slate-100' }, props.value || 'N/A'),
    ])
  },
})

const RouteLine = defineComponent({
  props: {
    label: { type: String, required: true },
    marker: { type: String, required: true },
    color: { type: String, required: true },
    value: { type: String, default: '' },
  },
  setup(props) {
    return () => h('div', { class: 'flex items-start gap-2' }, [
      h('span', { class: `flex h-5 w-5 shrink-0 items-center justify-center rounded-full border-2 border-white text-[10px] font-bold text-white shadow ${props.color}` }, props.marker),
      h('div', { class: 'min-w-0' }, [
        h('p', { class: 'font-bold text-slate-900 dark:text-slate-100' }, props.label),
        h('p', { class: 'truncate text-slate-600 dark:text-slate-400' }, props.value || 'N/A'),
      ]),
    ])
  },
})

onMounted(async () => {
  initTheme()

  try {
    const { data } = await getSettings()
    settings.value = data
  } catch {}

  const state = history.state?.tracking
  if (state) {
    hydrateShipment(state)
    loading.value = false
    await nextTick()
    initMap()
    return
  }

  const saved = new URLSearchParams(window.location.search).get('tracking') || sessionStorage.getItem('lastTracking')
  if (saved) {
    try {
      const { data } = await trackShipment(saved)
      hydrateShipment(data)
      loading.value = false
      await nextTick()
      initMap()
      return
    } catch {
      toast.error('Unable to load tracking details.')
    }
  }

  loading.value = false
})

onBeforeUnmount(() => {
  destroyMap()
})

function hydrateShipment(data) {
  courier.value = data.courier
  tracks.value = data.tracks || []
  summary.value = data.summary || {}
}

function initTheme() {
  const saved = localStorage.getItem(themeStorageKey)
  isDark.value = saved
    ? saved === 'dark'
    : window.matchMedia?.('(prefers-color-scheme: dark)').matches
}

function toggleTheme() {
  isDark.value = !isDark.value
  localStorage.setItem(themeStorageKey, isDark.value ? 'dark' : 'light')
}

function findTrack(status) {
  return tracks.value.find((track) => normalizeStatus(track.status) === normalizeStatus(status))
}

function normalizeStatus(status) {
  return String(status || '').trim().toLowerCase()
}

function clean(value) {
  const text = String(value || '').trim()
  return text === ',' ? '' : text
}

function stepIcon() {
  return defineComponent({
    setup() {
      return () => h('svg', { viewBox: '0 0 24 24', fill: 'none', stroke: 'currentColor' }, [
        h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M20 6 9 17l-5-5' }),
      ])
    },
  })
}

async function initMap() {
  if (!mapRef.value || !courier.value) return
  destroyMap()

  mapInstance = L.map(mapRef.value, {
    dragging: false,
    touchZoom: false,
    scrollWheelZoom: false,
    doubleClickZoom: false,
    boxZoom: false,
    keyboard: false,
    zoomControl: false,
    attributionControl: true,
  }).setView([20, 0], 2)

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors',
    maxZoom: 18,
  }).addTo(mapInstance)

  const points = await Promise.all([
    geocode(originAddress.value),
    geocode(currentAddress.value),
    geocode(destinationAddress.value),
  ])

  const validPoints = points.filter(Boolean)
  if (!validPoints.length) return

  validPoints.forEach((point, index) => {
    L.marker(point, { icon: markerIcon(index) }).addTo(mapInstance)
  })

  if (validPoints.length > 1) {
    const route = L.polyline(validPoints, {
      color: '#facc15',
      weight: 5,
      opacity: 0.92,
    }).addTo(mapInstance)

    mapInstance.fitBounds(route.getBounds(), { padding: [48, 48], maxZoom: 9, animate: false })
  } else {
    mapInstance.setView(validPoints[0], 5)
  }
}

function destroyMap() {
  if (mapInstance) {
    mapInstance.remove()
    mapInstance = null
  }
}

async function geocode(address) {
  if (!address) return null
  try {
    const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&limit=1&accept-language=en&q=${encodeURIComponent(address)}`)
    const data = await response.json()
    if (!data?.length) return null
    return [Number(data[0].lat), Number(data[0].lon)]
  } catch {
    return null
  }
}

function markerIcon(index) {
  const colors = ['#2563eb', '#f59e0b', '#059669']
  const labels = ['A', 'B', 'C']
  return L.divIcon({
    html: `<div style="background:${colors[index] || '#dc2626'};width:28px;height:28px;border-radius:999px;border:3px solid white;color:white;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;box-shadow:0 10px 22px rgba(15,23,42,.25)">${labels[index] || ''}</div>`,
    className: '',
    iconSize: [28, 28],
    iconAnchor: [14, 14],
  })
}

function statusPillClass(status, dark = false) {
  const normalized = normalizeStatus(status)
  if (normalized === 'delivered') return dark ? 'bg-emerald-400 text-emerald-950' : 'bg-emerald-100 text-emerald-800'
  if (normalized === 'custom hold' || normalized === 'at customs') return dark ? 'bg-amber-300 text-amber-950' : 'bg-amber-100 text-amber-800'
  if (normalized === 'on hold') return dark ? 'bg-red-300 text-red-950' : 'bg-red-100 text-red-800'
  return dark ? 'bg-white text-slate-900' : 'bg-blue-100 text-blue-800'
}

function timelineDotClass(status) {
  const normalized = normalizeStatus(status)
  if (normalized === 'delivered') return 'bg-emerald-600'
  if (normalized === 'custom hold' || normalized === 'at customs') return 'bg-amber-500'
  if (normalized === 'on hold') return 'bg-red-600'
  return 'bg-red-600'
}

function progressSegmentClass(index) {
  const nextStep = progressSteps.value[index]
  if (!nextStep?.done) return 'bg-slate-200 dark:bg-slate-700'
  if (nextStep.label === 'Custom Hold') return 'bg-amber-500'
  if (nextStep.label === 'Delivered') return 'bg-emerald-600'
  return 'bg-red-600'
}

function placeLine(track) {
  return [clean(track.city), clean(track.country)].filter(Boolean).join(', ') || 'Location not available'
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

function fmt(value) {
  return Number(value || 0).toLocaleString('en-US', {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2,
  })
}
</script>
