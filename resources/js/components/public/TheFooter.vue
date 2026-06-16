<template>
  <footer class="footer-section">
    <div class="map-pattern"></div>
    <div class="footer-wrapper">
      <div class="container">
        <div class="row gy-lg-0 gy-4">
          <div class="col-lg-3 col-md-6">
            <div class="footer-widget">
              <router-link to="/" class="footer-logo">
                <img v-if="settings.logoDarkUrl" :src="settings.logoDarkUrl" alt="logo">
                <span v-else class="fw-bold text-white">{{ settings.siteName }}</span>
              </router-link>
              <p>{{ settings.siteName }} specializes in efficient transport, warehousing and global distribution of goods.</p>
              <ul class="social-share">
                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-tiktok"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="footer-widget widget-links">
              <div class="widget-title"><h3>Company</h3></div>
              <ul class="footer-links">
                <li><router-link to="/about">About Us</router-link></li>
                <li><router-link to="/company">Company</router-link></li>
                <li><router-link to="/blog">Recent News</router-link></li>
                <li><router-link to="/faq">Help &amp; FAQs</router-link></li>
                <li><router-link to="/contact">Contact</router-link></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="footer-widget">
              <div class="widget-title"><h3>Get In Touch</h3></div>
              <ul class="footer-contact-info">
                <li v-if="settings.address">
                  <p><span>Address:</span>{{ settings.address }}</p>
                </li>
                <li v-if="settings.phone">
                  <p>
                    <span>Phone:</span>
                    <a :href="`tel:${settings.phone}`" class="footer-contact-link">{{ settings.phone }}</a>
                    <a v-if="settings.whatsapp" :href="`https://wa.me/${whatsappNumber}`" class="footer-wa-badge" target="_blank" rel="noopener">
                      <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </a>
                  </p>
                </li>
                <li v-if="settings.contactEmail">
                  <p><span>Mail Us:</span>
                    <a :href="`mailto:${settings.contactEmail}`" class="footer-contact-link">{{ settings.contactEmail }}</a>
                  </p>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="footer-widget">
              <div class="widget-title"><h3>Newsletter Signup</h3></div>
              <form @submit.prevent="subscribe" class="subscribe-form" novalidate>
                <div class="mc-fields">
                  <input class="form-control" type="email" v-model="email" placeholder="Your Email" required>
                  <button class="submit" type="submit"><i class="fa-regular fa-arrow-right-long"></i></button>
                </div>
                <div v-if="subMsg" class="mt-2 text-sm" :class="subError ? 'text-danger' : 'subscription-success'">{{ subMsg }}</div>
              </form>
              <p class="mt-20">Subscribe and get the latest logistics updates today.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="running-truck">
        <div class="truck"></div>
        <div class="truck-2"></div>
        <div class="truck-3"></div>
      </div>
    </div>
    <div class="copyright-area">
      &copy; {{ year }} {{ settings.siteName }}, All Rights Reserved.
    </div>
  </footer>

  <div id="scrollup">
    <button id="scroll-top" class="scroll-to-top"><i class="fa-regular fa-arrow-up"></i></button>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useSettingsStore } from '../../stores/useSettingsStore.js'

const settings = useSettingsStore()
const year     = new Date().getFullYear()
const email    = ref('')
const subMsg   = ref('')
const subError = ref(false)

const whatsappNumber = computed(() => {
  return (settings.whatsapp || settings.phone || '').replace(/\D/g, '')
})

function subscribe() {
  if (!email.value) return
  subMsg.value   = 'Thank you for subscribing!'
  subError.value = false
  email.value    = ''
}
</script>

<style scoped>
.footer-contact-link {
  color: inherit;
  text-decoration: none;
}
.footer-contact-link:hover { text-decoration: underline; }

.footer-wa-badge {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  background: #25d366;
  color: #fff;
  font-size: 0.75rem;
  padding: 2px 8px;
  border-radius: 20px;
  margin-left: 8px;
  text-decoration: none;
  font-weight: 600;
  vertical-align: middle;
}
.footer-wa-badge:hover { background: #128c4e; }
</style>
