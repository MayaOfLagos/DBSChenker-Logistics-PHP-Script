<template>
  <div>
    <!-- Preloader -->
    <div id="preloader-wrap">
      <svg viewBox="0 0 1000 1000" preserveAspectRatio="none">
        <path id="preloader-bg" d="M0,1005S175,995,500,995s500,5,500,5V0H0Z"></path>
      </svg>
      <div class="site-preloader preloader-text">
        <span data-text="D">D</span>
        <span data-text="B">B</span>
      </div>
    </div>

    <TheHeader />
    <slot />
    <TheFooter />
  </div>
</template>

<script setup>
import { nextTick, onBeforeUnmount, onMounted, watch } from 'vue'
import TheHeader from '../components/public/TheHeader.vue'
import TheFooter from '../components/public/TheFooter.vue'
import { useSettingsStore } from '../stores/useSettingsStore.js'

const settingsStore = useSettingsStore()
settingsStore.fetch()

let stickyScrollHandler = null
let stopStickyWatcher = null

function removeStickyHeader() {
  document.querySelectorAll('.sticky-header').forEach((header) => header.remove())

  if (stickyScrollHandler) {
    window.removeEventListener('scroll', stickyScrollHandler)
    stickyScrollHandler = null
  }
}

function replacePlaceholderLogos(header) {
  header.querySelectorAll('img').forEach((image) => {
    const src = image.getAttribute('src') || ''
    const isPlaceholderLogo = /(^|\/)assets\/img\/logo(-light)?\.png($|\?)/.test(src)

    if (!isPlaceholderLogo) return

    if (settingsStore.logoUrl) {
      image.setAttribute('src', settingsStore.logoUrl)
      return
    }

    const textLogo = document.createElement('span')
    textLogo.className = 'fw-bold text-white fs-5'
    textLogo.textContent = settingsStore.siteName || 'DB Schenker'
    image.replaceWith(textLogo)
  })
}

function buildStickyHeader() {
  removeStickyHeader()

  if (window.innerWidth <= 992) return

  const mainHeader = Array.from(document.querySelectorAll('.main-header'))
    .find((header) => !header.closest('.sticky-header'))

  if (!mainHeader) return

  const stickyHeader = document.createElement('div')
  const headerClone = mainHeader.cloneNode(true)
  stickyHeader.className = 'sticky-header'
  replacePlaceholderLogos(headerClone)
  stickyHeader.appendChild(headerClone)
  mainHeader.after(stickyHeader)

  const triggerPoint = mainHeader.offsetHeight
  stickyScrollHandler = () => {
    stickyHeader.classList.toggle('sticky-fixed-top', window.scrollY >= triggerPoint)
  }
  window.addEventListener('scroll', stickyScrollHandler, { passive: true })
  stickyScrollHandler()
}

async function syncStickyHeader() {
  await nextTick()
  buildStickyHeader()
}

onMounted(() => {
  syncStickyHeader()
  stopStickyWatcher = watch(
    () => [settingsStore.loaded, settingsStore.logoUrl, settingsStore.siteName],
    syncStickyHeader,
    { flush: 'post' }
  )
  window.addEventListener('resize', syncStickyHeader)

  // Preloader
  if (typeof gsap !== 'undefined') {
    const tl = gsap.timeline()
    const svgCurve = 'M0 502S175 272 500 272s500 230 500 230V0H0Z'
    const svgFlat = 'M0 2S175 1 500 1s500 1 500 1V0H0Z'
    tl.to('#preloader-wrap .site-preloader', { delay: 1, y: -70, opacity: 0 })
      .to('#preloader-bg', { duration: 0.7, attr: { d: svgCurve }, ease: 'power2.easeIn' })
      .to('#preloader-bg', { duration: 0.7, attr: { d: svgFlat }, ease: 'power2.easeOut' })
      .to('#preloader-wrap', { y: -1500 })
    setTimeout(() => {
      const el = document.getElementById('preloader-wrap')
      if (el) el.remove()
    }, 4000)
  } else {
    setTimeout(() => {
      const el = document.getElementById('preloader-wrap')
      if (el) el.remove()
    }, 500)
  }
})

onBeforeUnmount(() => {
  removeStickyHeader()
  stopStickyWatcher?.()
  window.removeEventListener('resize', syncStickyHeader)
})
</script>
