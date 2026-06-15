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
import { Toaster } from '@steveyuowo/vue-hot-toast'
import { useSiteIntegrations } from './composables/useSiteIntegrations.js'

const { showTranslate } = useSiteIntegrations()
</script>

<style>
.fade-enter-active, .fade-leave-active { transition: opacity 0.15s ease; }
.fade-enter-from, .fade-leave-to       { opacity: 0; }
</style>
