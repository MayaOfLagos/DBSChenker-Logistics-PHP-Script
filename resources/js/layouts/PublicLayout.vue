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
import { onMounted } from 'vue'
import TheHeader from '../components/public/TheHeader.vue'
import TheFooter from '../components/public/TheFooter.vue'
import { useSettingsStore } from '../stores/useSettingsStore.js'

const settingsStore = useSettingsStore()
settingsStore.fetch()

onMounted(() => {
  // Sticky header clone
  if (typeof $ !== 'undefined' && $(window).width() > 992) {
    const mainHeader = $('.main-header')
    if (mainHeader.length && !$('.sticky-header').length) {
      mainHeader.after('<div class="sticky-header"></div>')
      $('.sticky-header').html(mainHeader.clone())
      $(window).on('scroll.sticky', function () {
        if ($(window).scrollTop() >= mainHeader.height()) {
          $('.sticky-header').addClass('sticky-fixed-top')
        } else {
          $('.sticky-header').removeClass('sticky-fixed-top')
        }
      })
    }
  }

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
</script>
