<template>
  <router-view />
  <Toaster position="top-right" />
</template>

<script setup>
import { onMounted } from 'vue'
import { Toaster } from '@steveyuowo/vue-hot-toast'
import { getSettings } from './api/index.js'

onMounted(async () => {
  try {
    const { data } = await getSettings()

    if (data.favicon_url) {
      let link = document.querySelector("link[rel~='icon']")
      if (!link) {
        link = document.createElement('link')
        link.rel = 'icon'
        document.head.appendChild(link)
      }
      link.href = data.favicon_url
    }

    if (data.site_name) {
      window.__SITE_NAME__ = data.site_name
    }
  } catch {}
})
</script>
