<template>
  <div :class="{ dark: isDark }">
    <div class="min-h-screen bg-slate-100 text-slate-900 transition-colors duration-300 dark:bg-slate-950 dark:text-slate-100">

      <!-- ══ HEADER ══════════════════════════════════════════════════════════════ -->
      <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/97 shadow-sm backdrop-blur-md no-print dark:border-slate-800/80 dark:bg-slate-950/97">
        <div class="mx-auto flex max-w-7xl items-center justify-between gap-3 px-4 py-3 sm:px-6 lg:px-8">
          <a href="/track" class="inline-flex items-center gap-1.5 rounded-lg px-2.5 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-red-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-red-400">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            <span class="hidden sm:inline">Track Another</span>
          </a>
          <div class="flex items-center gap-2">
            <img v-if="activeLogo" :src="activeLogo" :alt="settings.site_name" class="h-8 w-auto max-w-[9rem] object-contain sm:h-9">
            <span v-else class="text-sm font-bold text-slate-900 dark:text-white">{{ settings.site_name || 'Logistics' }}</span>
          </div>
          <button type="button" @click="toggleTheme"
            class="flex h-9 w-9 items-center justify-center rounded-full text-slate-600 transition hover:bg-slate-100 hover:text-red-600 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-red-400"
            :aria-label="isDark ? 'Light mode' : 'Dark mode'">
            <svg v-if="isDark" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.36-6.36-1.42 1.42M7.05 16.95l-1.41 1.41m12.72 0-1.42-1.41M7.05 7.05 5.64 5.64"/>
              <circle cx="12" cy="12" r="4" stroke-width="1.8"/>
            </svg>
            <svg v-else class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12.79A8.5 8.5 0 1 1 11.21 3 6.7 6.7 0 0 0 21 12.79z"/>
            </svg>
          </button>
        </div>
      </header>

      <main class="mx-auto max-w-7xl px-4 py-4 sm:px-6 sm:py-6 lg:px-8">

        <!-- Loading -->
        <div v-if="loading" class="flex min-h-[60vh] items-center justify-center">
          <div class="flex flex-col items-center gap-4 rounded-2xl bg-white p-10 shadow-sm ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
            <svg class="h-10 w-10 animate-spin text-red-600" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
            </svg>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">Fetching shipment record…</p>
          </div>
        </div>

        <template v-else-if="courier">

          <!-- ══ HERO CARD ════════════════════════════════════════════════════════ -->
          <section class="relative mb-4 overflow-hidden rounded-2xl bg-slate-950 shadow-xl sm:mb-5">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(239,68,68,0.3),_transparent_55%),linear-gradient(150deg,_rgba(15,23,42,1),_rgba(30,41,59,0.95))]"></div>
            <div class="relative p-5 sm:p-7 lg:flex lg:items-start lg:justify-between lg:gap-8 lg:p-8">
              <div class="flex-1 min-w-0">
                <div class="mb-3 inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-3 py-1 text-xs font-semibold text-white/80">
                  <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                  Verified Shipment
                </div>
                <p class="text-[10px] font-semibold tracking-widest text-white/50 uppercase sm:text-xs">Tracking Number</p>
                <div class="mt-1.5 flex flex-wrap items-center gap-2">
                  <h1 class="font-mono text-xl font-bold tracking-widest text-white sm:text-3xl lg:text-4xl break-all">{{ courier.trackingnumber }}</h1>
                  <span :class="statusPillClass(courier.status, true)" class="rounded-full px-2.5 py-1 text-[10px] font-bold sm:text-xs">
                    {{ courier.status || 'In Processing' }}
                  </span>
                </div>
                <p class="mt-2 flex flex-wrap items-center gap-1.5 text-xs text-white/55 sm:text-sm">
                  Updated {{ formatDateTime(lastUpdated) }}
                  <span v-if="isLive" class="inline-flex items-center gap-1 rounded-full bg-emerald-500/20 px-2 py-0.5 text-[10px] font-bold text-emerald-400 sm:text-xs">
                    <span class="relative flex h-1.5 w-1.5">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                      <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                    </span>
                    Live
                  </span>
                </p>
              </div>
              <!-- Shipment Status -->
              <div class="mt-4 flex items-center gap-3 lg:mt-0 lg:shrink-0">
                <div class="rounded-xl border border-white/15 bg-white/10 px-4 py-3 backdrop-blur-md sm:px-5 sm:py-4">
                  <p class="text-[10px] font-semibold uppercase tracking-wider text-white/50">Shipment Status</p>
                  <p class="mt-1.5 text-xl font-black text-white sm:text-2xl">{{ courier.status || 'In Processing' }}</p>
                  <span :class="statusPillClass(courier.status, true)" class="mt-2 inline-flex rounded-full px-2.5 py-1 text-[10px] font-bold sm:text-xs">
                    {{ courier.status || 'In Processing' }}
                  </span>
                </div>
                <img :src="stampImage" alt="" class="h-16 w-16 rotate-[-8deg] object-contain opacity-40 sm:h-20 sm:w-20 lg:h-24 lg:w-24">
              </div>
            </div>
          </section>

          <!-- ══ MOBILE QUICK ACTIONS ════════════════════════════════════════════ -->
          <div class="mb-4 flex flex-col gap-2 sm:hidden no-print">
            <div class="flex w-full items-center justify-between gap-2 rounded-xl bg-slate-800 px-4 py-3.5 text-sm text-white shadow-sm">
              <span class="flex items-center gap-2 font-medium text-slate-300">
                <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Expected Delivery
              </span>
              <span class="font-bold">{{ formatDateTime(courier.expected_delivery) }}</span>
            </div>
          </div>

          <!-- ══ PROGRESS STEPPER ════════════════════════════════════════════════ -->
          <section class="mb-4 rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800 sm:mb-5">
            <div class="flex items-center justify-between border-b border-slate-100 px-4 py-3 dark:border-slate-800 sm:px-6 sm:py-4">
              <h2 class="text-sm font-bold text-slate-900 dark:text-white sm:text-base">Shipment Progress</h2>
              <div class="flex items-center gap-2">
                <div class="h-1.5 w-20 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800 sm:w-32">
                  <div class="h-1.5 rounded-full bg-red-600 transition-all duration-700" :style="{ width: `${courier.percentage_complete ?? progressPercent}%` }"></div>
                </div>
                <span class="text-xs font-bold tabular-nums text-slate-500 dark:text-slate-400">{{ courier.percentage_complete ?? progressPercent }}%</span>
              </div>
            </div>

            <!-- Horizontal scrollable on all sizes -->
            <div class="overflow-x-auto px-4 py-5 sm:px-6 sm:py-6" style="-webkit-overflow-scrolling:touch">
              <div class="relative flex min-w-max items-start">
                <!-- Connector segments sit behind the icons -->
                <div class="absolute left-7 right-7 top-7 z-0 flex sm:top-8 sm:left-8 sm:right-8">
                  <div v-for="idx in progressSteps.length - 1" :key="`seg-${idx}`"
                       :class="progressSegmentClass(idx)"
                       class="h-1 flex-1 transition-colors duration-500"></div>
                </div>
                <!-- Steps -->
                <div v-for="step in progressSteps" :key="step.key"
                     class="relative z-10 flex w-28 flex-col items-center px-1 text-center sm:w-32 sm:px-2">
                  <div :class="step.done ? step.activeClass : 'bg-slate-200 text-slate-400 dark:bg-slate-700 dark:text-slate-500'"
                       class="flex h-14 w-14 items-center justify-center rounded-full border-4 border-white shadow-md transition-all duration-500 dark:border-slate-900 sm:h-16 sm:w-16">
                    <component :is="step.icon" class="h-5 w-5 sm:h-6 sm:w-6"/>
                  </div>
                  <h3 :class="step.done ? 'text-slate-900 dark:text-white' : 'text-slate-400 dark:text-slate-500'"
                      class="mt-2.5 text-[11px] font-bold leading-tight transition-colors sm:text-sm">{{ step.label }}</h3>
                  <p class="mt-1 text-[10px] text-slate-400 dark:text-slate-500 sm:text-xs">{{ step.date ? formatDate(step.date) : '—' }}</p>
                </div>
              </div>
            </div>
          </section>

          <!-- ══ INFO CARDS (2-col on mobile, 4-col on xl) ══════════════════════ -->
          <section class="mb-4 grid grid-cols-2 gap-3 sm:mb-5 sm:gap-4 xl:grid-cols-4">
            <InfoCard title="Sender" :items="senderInfo" />
            <InfoCard title="Receiver" :items="receiverInfo" />
            <InfoCard title="Shipment" :items="shipmentDetails" />
            <InfoCard title="Status" :items="statusInfo" />
          </section>

          <!-- ══ HISTORY + MAP ════════════════════════════════════════════════════ -->
          <section class="mb-4 grid gap-4 sm:mb-5 lg:grid-cols-[0.85fr_1.5fr]">

            <!-- History timeline -->
            <div class="rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
              <SectionHeader title="Shipment History" :meta="`${tracks.length} update${tracks.length !== 1 ? 's' : ''}`" />
              <div class="p-4 sm:p-5">
                <div v-if="tracks.length" class="relative">
                  <div class="absolute left-3.5 top-1 bottom-1 w-px bg-slate-100 dark:bg-slate-800"></div>
                  <article v-for="track in tracks" :key="track.id" class="relative mb-3.5 flex gap-3 last:mb-0">
                    <div :class="timelineDotClass(track.status)"
                         class="relative z-10 mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-full border-2 border-white shadow-sm dark:border-slate-900">
                      <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 8v4l3 2"/>
                        <circle cx="12" cy="12" r="9" stroke-width="2"/>
                      </svg>
                    </div>
                    <div class="min-w-0 flex-1 rounded-xl border border-slate-100 bg-slate-50 px-3 py-2.5 dark:border-slate-800 dark:bg-slate-950/60">
                      <div class="flex flex-wrap items-start justify-between gap-1">
                        <span :class="statusPillClass(track.status)" class="rounded-full px-2 py-0.5 text-[10px] font-bold sm:text-xs">
                          {{ track.status || 'Update' }}
                        </span>
                        <span class="text-[10px] text-slate-400 dark:text-slate-500 sm:text-xs">{{ formatDateTime(track.created_at) }}</span>
                      </div>
                      <p class="mt-1.5 text-xs font-bold text-slate-800 dark:text-slate-100 sm:text-sm">{{ placeLine(track) }}</p>
                      <p v-if="track.comment" class="mt-1 text-xs leading-5 text-slate-500 dark:text-slate-400">{{ track.comment }}</p>
                    </div>
                  </article>
                </div>
                <div v-else class="rounded-xl border border-dashed border-slate-200 px-4 py-8 text-center text-xs text-slate-400 dark:border-slate-700 dark:text-slate-500">
                  No updates yet — check back later.
                </div>
              </div>
            </div>

            <!-- Map -->
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
              <SectionHeader title="Shipment Route" meta="OpenStreetMap"/>
              <!-- Map tile — compact on mobile, taller on desktop -->
              <div class="relative h-60 bg-slate-200 dark:bg-slate-950 sm:h-72 lg:h-[28rem]">
                <div ref="mapRef" class="h-full w-full"></div>
                <!-- Journey overlay (desktop only, where map is tall enough) -->
                <div class="absolute bottom-3 left-3 z-[500] hidden w-64 rounded-xl bg-white/96 p-3 shadow-lg backdrop-blur dark:bg-slate-950/96 dark:ring-1 dark:ring-slate-800 lg:block">
                  <p class="mb-2 text-[10px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Journey Timeline</p>
                  <div class="max-h-48 overflow-y-auto pr-0.5">
                    <div v-for="(wp, i) in routeWaypoints" :key="i" class="relative flex gap-2 pb-2.5 last:pb-0">
                      <div v-if="i < routeWaypoints.length - 1"
                           class="absolute left-[9px] top-5 w-px"
                           :class="wp.done && routeWaypoints[i+1]?.done ? 'bg-red-300' : 'bg-slate-200 dark:bg-slate-700'"
                           style="bottom:-2px"></div>
                      <span class="relative z-10 mt-0.5 flex h-[18px] w-[18px] shrink-0 items-center justify-center rounded-full border-2 border-white text-[8px] font-extrabold text-white shadow dark:border-slate-950"
                            :class="wp.role==='origin'?'bg-blue-600':wp.role==='destination'?(wp.done?'bg-emerald-600':'bg-slate-400'):i===routeWaypoints.length-2&&routeWaypoints[routeWaypoints.length-1]?.role==='destination'?'bg-amber-500':'bg-red-600'">
                        {{ wp.role==='origin'?'A':wp.role==='destination'?'Z':i }}
                      </span>
                      <div class="min-w-0 flex-1">
                        <p class="truncate text-[10px] font-bold text-slate-900 dark:text-slate-100">{{ wp.label }}</p>
                        <p class="text-[9px] text-slate-400 dark:text-slate-500">{{ wp.status }}{{ wp.date ? ' · '+formatDate(wp.date) : '' }}</p>
                      </div>
                    </div>
                  </div>
                  <a :href="googleMapsUrl" target="_blank" rel="noopener"
                     class="mt-2 inline-flex items-center gap-1 text-[10px] font-bold text-red-600 hover:text-red-700 dark:text-red-400">
                    <svg class="h-2.5 w-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Open in Google Maps
                  </a>
                </div>
              </div>
              <!-- Below-map journey timeline (mobile + tablet) -->
              <div class="border-t border-slate-100 dark:border-slate-800 lg:hidden">
                <div class="overflow-x-auto px-4 py-3" style="-webkit-overflow-scrolling:touch">
                  <div class="flex min-w-max gap-0">
                    <div v-for="(wp, i) in routeWaypoints" :key="i"
                         class="relative flex w-[7rem] flex-col items-center px-1">
                      <!-- horizontal connector -->
                      <div v-if="i < routeWaypoints.length - 1"
                           class="absolute top-[9px] left-[calc(50%+9px)] right-[-50%] h-px"
                           :class="wp.done && routeWaypoints[i+1]?.done ? 'bg-red-300' : 'bg-slate-200 dark:bg-slate-700'"></div>
                      <span class="relative z-10 flex h-[18px] w-[18px] shrink-0 items-center justify-center rounded-full border-2 border-white text-[8px] font-extrabold text-white shadow dark:border-slate-900"
                            :class="wp.role==='origin'?'bg-blue-600':wp.role==='destination'?(wp.done?'bg-emerald-600':'bg-slate-400'):i===routeWaypoints.length-2&&routeWaypoints[routeWaypoints.length-1]?.role==='destination'?'bg-amber-500':'bg-red-600'">
                        {{ wp.role==='origin'?'A':wp.role==='destination'?'Z':i }}
                      </span>
                      <p class="mt-1.5 w-full truncate text-center text-[9px] font-bold text-slate-800 dark:text-slate-100">{{ wp.label }}</p>
                      <p class="text-[8px] text-slate-400 dark:text-slate-500">{{ wp.status }}</p>
                    </div>
                  </div>
                </div>
                <div class="border-t border-slate-100 px-4 py-2 dark:border-slate-800">
                  <a :href="googleMapsUrl" target="_blank" rel="noopener"
                     class="inline-flex items-center gap-1 text-xs font-bold text-red-600 hover:text-red-700 dark:text-red-400">
                    <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Open in Google Maps
                  </a>
                </div>
              </div>
            </div>
          </section>

          <!-- ══ PARCEL INFO ══════════════════════════════════════════════════════ -->
          <section class="mb-4 overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800 sm:mb-5">
            <SectionHeader title="Parcel Information"/>
            <div class="p-4 sm:p-5 lg:p-6">
              <div class="grid grid-cols-2 gap-3 sm:gap-4 xl:grid-cols-3">
                <MiniStat title="Duty Fees" :value="courier.cstatus || 'N/A'"/>
                <MiniStat title="Weight" :value="weightLabel"/>
                <MiniStat title="Pickup Date" :value="formatDateTime(courier.date_shipped)"/>
                <MiniStat title="Est. Delivery" :value="formatDateTime(courier.expected_delivery)"/>
                <MiniStat title="Delivery Mode" :value="courier.freight_type || 'N/A'"/>
                <MiniStat title="Status" :value="courier.status || 'N/A'"/>
              </div>

              <div v-if="parcelPhotoUrl" class="mt-4 overflow-hidden rounded-xl">
                <img :src="parcelPhotoUrl" alt="Parcel photo" class="w-full object-cover" style="max-height:240px">
              </div>

              <!-- Desktop actions -->
              <div class="mt-4 hidden gap-3 sm:flex sm:flex-wrap no-print">
                <router-link :to="{ name: 'printinvoice', params: { id: courier.id } }" class="btn-secondary">
                  <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 9V3h12v6M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2M6 14h12v7H6z"/></svg>
                  Print Receipt
                </router-link>
                <router-link :to="{ name: 'invoice', params: { id: courier.id } }" class="btn-secondary">View Invoice</router-link>
              </div>

              <!-- Help row -->
              <div v-if="settings.contact_email || settings.whatsapp"
                   class="mt-4 flex flex-wrap items-center gap-3 border-t border-slate-100 pt-4 dark:border-slate-800 no-print">
                <span class="text-xs text-slate-500">Need help?</span>
                <a v-if="settings.contact_email" :href="`mailto:${settings.contact_email}`"
                   class="inline-flex items-center gap-1 text-xs font-semibold text-slate-700 transition hover:text-red-600 dark:text-slate-300 dark:hover:text-red-400">
                  <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                  {{ settings.contact_email }}
                </a>
                <a v-if="settings.whatsapp" :href="`https://wa.me/${settings.whatsapp.replace(/\D/g,'')}`" target="_blank" rel="noopener"
                   class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 transition hover:text-emerald-700">
                  <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347"/></svg>
                  WhatsApp
                </a>
              </div>
            </div>
          </section>

        </template>

        <!-- Not found -->
        <div v-else-if="!loading" class="rounded-2xl bg-white p-10 text-center shadow-sm ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800">
          <svg class="mx-auto mb-4 h-14 w-14 text-slate-300 dark:text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 0 1 5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"/>
          </svg>
          <h2 class="text-lg font-bold text-slate-700 dark:text-slate-100">No shipment found</h2>
          <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">We couldn't find a shipment with that tracking number.</p>
          <a href="/track" class="btn-primary mt-6 inline-flex">Try Again</a>
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
const isLive = ref(false)
const activeLogo = computed(() =>
  isDark.value
    ? (settings.value?.logo_dark_url ?? settings.value?.logo_url ?? null)
    : (settings.value?.logo_light_url ?? settings.value?.logo_url ?? null)
)
const activeTracking = ref('')  // tracking number used for polling
let mapInstance = null
let pollTimer = null
const POLL_INTERVAL = 30_000

const themeStorageKey = 'tracking-result-theme'

const statusOrder = computed(() =>
  (settings.value?.shipment_statuses?.length >= 2)
    ? settings.value.shipment_statuses
    : ['Order Confirmed', 'Picked by Courier', 'On The Way', 'Custom Hold', 'Delivered']
)

// Semantic positions: 4th slot = hold/warning, last slot = delivered
const deliveredStatus = computed(() => statusOrder.value[statusOrder.value.length - 1])
const holdStatus      = computed(() => statusOrder.value.length >= 4 ? statusOrder.value[3] : null)

const latestTrack = computed(() => tracks.value?.[0] || null)
const currency = computed(() => summary.value?.currency || settings.value?.s_currency || settings.value?.currency || '$')
const totalDue = computed(() => Number(summary.value?.total_due ?? ((+courier.value?.cost || 0) + (+courier.value?.clearance_cost || 0))))
const lastUpdated = computed(() => latestTrack.value?.created_at || courier.value?.updated_at || courier.value?.date_shipped)
const stampImage = computed(() => courier.value?.status === deliveredStatus.value ? '/temp/stamp1.png' : '/temp/stamp2.png')
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
const progressPercent = computed(() => Math.round((completedSteps.value / statusOrder.value.length) * 100))
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
// All shipment stops in journey order for the map timeline
const routeWaypoints = computed(() => {
  const pts = []

  // 1 — Origin
  const origin = clean(originAddress.value)
  if (origin) {
    pts.push({
      label: courier.value?.take_off_point || origin,
      address: origin,
      role: 'origin',
      date: courier.value?.date_shipped,
      status: 'Picked Up',
      done: true,
    })
  }

  // 2 — Each historical location oldest → newest (tracks are newest-first, so reverse)
  const chronological = [...(tracks.value || [])].reverse()
  for (const track of chronological) {
    const addr = [clean(track.city), clean(track.country)].filter(Boolean).join(', ')
               || clean(track.address)
    if (!addr) continue
    // Skip consecutive duplicates
    if (pts.length && pts[pts.length - 1].address.toLowerCase() === addr.toLowerCase()) continue
    pts.push({
      label: addr,
      address: addr,
      role: 'waypoint',
      date: track.created_at,
      status: track.status || 'In Transit',
      done: true,
    })
  }

  // 3 — Destination
  const dest = clean(destinationAddress.value)
  if (dest) {
    const isDelivered = courier.value?.status === deliveredStatus.value
    if (!pts.length || pts[pts.length - 1].address.toLowerCase() !== dest.toLowerCase()) {
      pts.push({
        label: courier.value?.final_destination || courier.value?.address || dest,
        address: dest,
        role: 'destination',
        date: isDelivered ? tracks.value?.[0]?.created_at : courier.value?.expected_delivery,
        status: isDelivered ? deliveredStatus.value : 'Expected Arrival',
        done: isDelivered,
      })
    }
  }

  return pts
})

const googleMapsUrl = computed(() => {
  const parts = routeWaypoints.value.map(wp => encodeURIComponent(wp.address)).filter(Boolean)
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
  const order = statusOrder.value
  return order.map((label, index) => {
    const track = findTrack(label)
    const isFirst = index === 0
    const done = isFirst || Boolean(track) || order.indexOf(courier.value?.status) >= index
    const isHold      = label === holdStatus.value
    const isDelivered = label === deliveredStatus.value
    return {
      key: label,
      label,
      done,
      date: isFirst ? courier.value?.date_shipped : track?.created_at,
      activeClass: isHold
        ? 'bg-amber-500 text-white'
        : isDelivered
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
    return () => h('div', { class: 'flex items-center justify-between gap-3 border-b border-slate-200 bg-slate-50 px-4 py-3 dark:border-slate-800 dark:bg-slate-950/70 sm:px-5 sm:py-4' }, [
      h('h2', { class: 'text-sm font-bold text-slate-900 dark:text-white sm:text-base' }, props.title),
      props.meta ? h('span', { class: 'text-[10px] font-semibold text-slate-400 dark:text-slate-500 sm:text-xs' }, props.meta) : null,
    ])
  },
})

const InfoCard = defineComponent({
  props: {
    title: { type: String, required: true },
    items: { type: Array, required: true },
  },
  setup(props) {
    return () => h('article', { class: 'rounded-2xl bg-white p-3.5 shadow-sm ring-1 ring-slate-200 dark:bg-slate-900 dark:ring-slate-800 sm:p-5' }, [
      h('h2', { class: 'mb-2.5 text-[10px] font-bold uppercase tracking-wider text-red-600 sm:mb-4 sm:text-xs' }, props.title),
      h('dl', { class: 'space-y-2 sm:space-y-3' }, props.items.map((item) => h('div', {}, [
        h('dt', { class: 'text-[9px] font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 sm:text-[10px]' }, item.label),
        h('dd', { class: 'mt-0.5 break-words text-xs font-semibold text-slate-800 dark:text-slate-100 sm:text-sm' }, item.value || 'N/A'),
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
    return () => h('div', { class: 'rounded-xl border border-slate-200 bg-slate-50 p-3 dark:border-slate-800 dark:bg-slate-950/70 sm:p-4' }, [
      h('p', { class: 'text-[9px] font-semibold uppercase tracking-wide text-slate-400 dark:text-slate-500 sm:text-[10px]' }, props.title),
      h('p', { class: 'mt-1 break-words text-xs font-bold text-slate-800 dark:text-slate-100 sm:mt-2 sm:text-sm' }, props.value || 'N/A'),
    ])
  },
})


onMounted(async () => {
  initTheme()

  try {
    const { data } = await getSettings()
    settings.value = data
  } catch {}

  // URL query param is the most reliable source (survives page refresh)
  const urlTracking = new URLSearchParams(window.location.search).get('tracking')
  const storedTracking = sessionStorage.getItem('lastTracking')

  const state = history.state?.tracking
  if (state) {
    hydrateShipment(state)  // captures activeTracking from courier
    // If URL doesn't have it, fall back to what hydrateShipment captured
    if (urlTracking) activeTracking.value = urlTracking
    loading.value = false
    await nextTick()
    initMap()
    // Immediately fetch fresh data (history.state snapshot may be stale)
    await pollForUpdates()
    startPolling()
    return
  }

  const saved = urlTracking || storedTracking
  if (saved) {
    activeTracking.value = saved
    try {
      const { data } = await trackShipment(saved)
      hydrateShipment(data)
      loading.value = false
      await nextTick()
      initMap()
      startPolling()
      return
    } catch {
      toast.error('Unable to load tracking details.')
    }
  }

  loading.value = false
})

onBeforeUnmount(() => {
  stopPolling()
  destroyMap()
})

function hydrateShipment(data) {
  courier.value = data.courier
  tracks.value = data.tracks || []
  summary.value = data.summary || {}
  if (data.courier?.trackingnumber) {
    activeTracking.value = data.courier.trackingnumber
  }
}

async function pollForUpdates() {
  if (!activeTracking.value) return
  try {
    const { data } = await trackShipment(activeTracking.value)
    const prevStatus = courier.value?.status
    hydrateShipment(data)
    if (data.courier?.status !== prevStatus) {
      await nextTick()
      initMap()
    }
  } catch {
    // silent — don't surface background poll failures as toasts
  }
}

function startPolling() {
  stopPolling()
  isLive.value = true
  pollTimer = setInterval(pollForUpdates, POLL_INTERVAL)
}

function stopPolling() {
  if (pollTimer) {
    clearInterval(pollTimer)
    pollTimer = null
  }
  isLive.value = false
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

  const waypoints = routeWaypoints.value
  const coords = await Promise.all(waypoints.map(wp => geocode(wp.address)))

  // Pair waypoints with resolved coordinates, drop any that failed geocoding
  const resolved = waypoints
    .map((wp, i) => ({ ...wp, coords: coords[i] }))
    .filter(p => p.coords !== null)

  if (!resolved.length) return

  // Find the last completed stop index to split completed vs upcoming legs
  const lastDoneIdx = resolved.reduce((acc, p, i) => (p.done ? i : acc), -1)

  const completedCoords = resolved.slice(0, lastDoneIdx + 1).map(p => p.coords)
  const upcomingCoords  = resolved.slice(lastDoneIdx).map(p => p.coords) // starts at last done = bridge

  // Solid red line — completed journey
  if (completedCoords.length > 1) {
    L.polyline(completedCoords, { color: '#ef4444', weight: 4, opacity: 0.9 }).addTo(mapInstance)
  }

  // Dashed gray line — upcoming journey
  if (upcomingCoords.length > 1) {
    L.polyline(upcomingCoords, { color: '#94a3b8', weight: 3, opacity: 0.75, dashArray: '8 8' }).addTo(mapInstance)
  }

  // Place markers
  resolved.forEach((wp, i) => {
    const isCurrentStop = wp.done && (i === lastDoneIdx) && wp.role !== 'origin'
    const dotLabel = wp.role === 'origin' ? 'A' : wp.role === 'destination' ? 'Z' : String(i)
    const dotColor = wp.role === 'origin'      ? '#2563eb'
                   : wp.role === 'destination' ? (wp.done ? '#059669' : '#94a3b8')
                   : isCurrentStop             ? '#f59e0b'
                   : '#ef4444'

    const popup = `<div style="min-width:150px;font-family:inherit">
      <p style="font-weight:700;font-size:0.82rem;margin:0 0 2px">${wp.label}</p>
      <p style="color:#64748b;font-size:0.75rem;margin:0">${wp.status}${wp.date ? ' &middot; ' + formatDate(wp.date) : ''}</p>
    </div>`

    L.marker(wp.coords, { icon: markerIcon(dotLabel, dotColor) })
      .addTo(mapInstance)
      .bindPopup(popup, { maxWidth: 200 })
  })

  // Fit all resolved points in view
  if (resolved.length > 1) {
    mapInstance.fitBounds(L.latLngBounds(resolved.map(p => p.coords)), { padding: [48, 48], maxZoom: 9, animate: false })
  } else {
    mapInstance.setView(resolved[0].coords, 5)
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

function markerIcon(label, color = '#ef4444') {
  return L.divIcon({
    html: `<div style="background:${color};width:28px;height:28px;border-radius:999px;border:3px solid white;color:white;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:800;box-shadow:0 4px 14px rgba(15,23,42,.35)">${label}</div>`,
    className: '',
    iconSize: [28, 28],
    iconAnchor: [14, 14],
    popupAnchor: [0, -16],
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
  if (nextStep.label === holdStatus.value) return 'bg-amber-500'
  if (nextStep.label === deliveredStatus.value) return 'bg-emerald-600'
  return 'bg-red-600'
}

function placeLine(track) {
  return [clean(track.city), clean(track.country)].filter(Boolean).join(', ')
    || clean(track.address)
    || 'Location not available'
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
