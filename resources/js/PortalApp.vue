<template>
  <router-view />
  <Toaster position="top-right" />
  <div v-if="showTranslate" class="gtranslate_wrapper"></div>
</template>

<script setup>
import { Toaster } from '@steveyuowo/vue-hot-toast'
import { useSiteIntegrations } from './composables/useSiteIntegrations.js'

const { showTranslate } = useSiteIntegrations()
</script>
