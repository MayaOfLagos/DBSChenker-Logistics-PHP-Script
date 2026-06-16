<template>
  <div class="relative min-h-screen overflow-hidden bg-neutral-950 text-white">
    <img
      :src="heroImage"
      alt="Shipping containers and logistics yard"
      class="absolute inset-0 h-full w-full object-cover object-center"
    >
    <div class="absolute inset-0 bg-black/62"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-black/55 via-black/20 to-black/80"></div>

    <main class="relative z-10 mx-auto flex min-h-screen w-full max-w-7xl flex-col px-4 py-5 sm:px-6 lg:px-8">
      <header class="flex items-center justify-between gap-4">
        <a href="/" class="flex items-center gap-3">
          <img
            v-if="brandLogo"
            :src="brandLogo"
            :alt="brandName"
            class="h-10 w-auto max-w-[12rem] object-contain"
          >
          <div v-else class="flex h-11 w-11 items-center justify-center rounded-lg border border-white/15 bg-white/12 shadow-lg backdrop-blur-md">
            <span class="text-sm font-bold">{{ brandInitials }}</span>
          </div>
        </a>
      </header>

      <section class="flex flex-1 items-center justify-center py-10">
        <div class="w-full max-w-xl">
          <section class="rounded-lg border border-white/16 bg-neutral-950/72 p-5 shadow-[0_28px_100px_rgba(0,0,0,0.5)] backdrop-blur-xl sm:p-7">
            <div class="mx-auto mb-6 max-w-md text-center">
              <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-lg border border-white/14 bg-white/10 text-white shadow-lg">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.5 7.5h11v9h-11zM14.5 10.5h3.2l2.8 3v3h-6z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6.5 18.5a1.7 1.7 0 1 0 0-3.4 1.7 1.7 0 0 0 0 3.4zM17.5 18.5a1.7 1.7 0 1 0 0-3.4 1.7 1.7 0 0 0 0 3.4z" />
                </svg>
              </div>
              <p class="text-xs font-semibold uppercase text-white/55">Logistics tracking</p>
              <h2 class="mt-2 text-3xl font-semibold text-white sm:text-4xl">Track your shipment</h2>
              <p class="mt-3 text-sm leading-6 text-white/68">
                Enter your tracking number to view the latest shipment status.
              </p>
            </div>

            <form class="space-y-4" @submit.prevent="track">
              <div>
                <label class="mb-2 block text-sm font-semibold text-white/78" for="trackingNumber">
                  Tracking number
                </label>
                <div class="relative">
                  <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-neutral-400">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 1 0 0-15 7.5 7.5 0 0 0 0 15z" />
                    </svg>
                  </span>
                  <input
                    id="trackingNumber"
                    v-model="trackingNumber"
                    type="text"
                    class="input-field !h-14 !rounded-lg !border-white/20 !bg-white !pl-12 !text-base !font-semibold !text-neutral-950 uppercase placeholder:font-normal placeholder:normal-case placeholder:text-neutral-400 focus:!ring-2 focus:!ring-red-500"
                    placeholder="Enter tracking number"
                    autocomplete="off"
                    required
                  >
                </div>
              </div>

              <button
                type="submit"
                class="btn-primary h-14 w-full rounded-lg text-base"
                :disabled="loading"
              >
                <svg v-if="loading" class="h-5 w-5 animate-spin" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                </svg>
                <svg v-else class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 1 0-14 0 7 7 0 0 0 14 0z" />
                </svg>
                {{ loading ? 'Searching...' : 'Track shipment' }}
              </button>
            </form>
          </section>
        </div>
      </section>
    </main>
  </div>
</template>

<script setup>
import { computed, onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import { toast } from '@steveyuowo/vue-hot-toast'
import { getSettings, trackShipment } from '../api/index.js'

const router = useRouter()
const settings = ref({})
const trackingNumber = ref('')
const loading = ref(false)
const heroImage = 'https://images.pexels.com/photos/24244230/pexels-photo-24244230.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1280&fit=crop'

const brandName = computed(() => settings.value.site_name || window.__SITE_NAME__ || 'Logistics')
const brandLogo = computed(() =>
  settings.value.logo_dark_url || settings.value.logo_url ||
  (settings.value.logo ? `/storage/${settings.value.logo}` : '')
)
const brandInitials = computed(() => {
  const source = brandName.value.trim() || 'L'
  return source
    .split(/\s+/)
    .slice(0, 2)
    .map((part) => part[0])
    .join('')
    .toUpperCase()
})

async function track() {
  if (!trackingNumber.value.trim()) {
    toast.error('Enter a tracking number.')
    return
  }

  loading.value = true
  try {
    const tracking = trackingNumber.value.trim()
    const { data } = await trackShipment(tracking)
    sessionStorage.setItem('lastTracking', tracking)
    router.push({ name: 'result', query: { tracking }, state: { tracking: data } })
  } catch (e) {
    toast.error(e.response?.data?.message || 'Tracking number not found. Please check and try again.')
  } finally {
    loading.value = false
  }
}

onMounted(async () => {
  try {
    const { data } = await getSettings()
    settings.value = data
    if (data?.site_name) window.__SITE_NAME__ = data.site_name
  } catch {}
})
</script>
