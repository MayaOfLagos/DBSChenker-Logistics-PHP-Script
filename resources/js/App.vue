<template>
  <router-view v-slot="{ Component }">
    <transition name="fade" mode="out-in">
      <component :is="Component" />
    </transition>
  </router-view>
  <Toaster position="top-right" />
  <div v-if="showTranslate" class="gtranslate_wrapper"></div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { Toaster } from '@steveyuowo/vue-hot-toast'
import { getSettings } from './api/index.js'

const showTranslate = ref(false)

onMounted(async () => {
  try {
    const { data } = await getSettings()

    // Favicon
    if (data.favicon_url) {
      let link = document.querySelector("link[rel~='icon']")
      if (!link) {
        link = document.createElement('link')
        link.rel = 'icon'
        document.head.appendChild(link)
      }
      link.href = data.favicon_url
    }

    // Page title
    if (data.site_name) {
      document.title = data.site_name
    }

    // Tidio live chat
    if (data.tido) {
      const s = document.createElement('script')
      s.src = `//code.tidio.co/${data.tido}.js`
      s.async = true
      document.body.appendChild(s)
    }

    // Google Translate widget
    if (data.google_translate === 'on') {
      showTranslate.value = true

      window.gtranslateSettings = {
        default_language: 'en',
        native_language_names: true,
        detect_browser_language: true,
        wrapper_selector: '.gtranslate_wrapper',
      }

      const s = document.createElement('script')
      s.src = 'https://cdn.gtranslate.net/widgets/latest/float.js'
      s.defer = true
      document.body.appendChild(s)
    }
  } catch {}
})
</script>

<style>
.fade-enter-active, .fade-leave-active { transition: opacity 0.15s ease; }
.fade-enter-from, .fade-leave-to       { opacity: 0; }
</style>
