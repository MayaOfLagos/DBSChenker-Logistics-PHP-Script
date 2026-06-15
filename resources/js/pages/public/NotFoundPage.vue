<template>
  <PublicLayout>
    <section class="error-page padding">
      <div class="map-pattern"></div>
      <div class="container">
        <div class="error-wrapper">
          <img src="/assets/img/404.png" alt="404 error">
          <h2>Oops! That page can't be found.</h2>
          <p>It looks like nothing was found at this location. Try one of the links below or search again.</p>
          <router-link to="/" class="default-btn">Back To Homepage</router-link>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import PublicLayout from '../../layouts/PublicLayout.vue'
import { useTemplateInit } from '../../composables/useTemplateInit.js'

useTemplateInit()
</script>
