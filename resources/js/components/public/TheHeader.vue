<template>
  <header class="main-header">
    <div class="container">
      <div class="main-header-wapper">
        <div class="site-logo">
          <router-link to="/">
            <img v-if="settings.logoUrl" :src="settings.logoUrl" alt="DB Schenker" />
            <span v-else class="fw-bold text-white fs-5">{{ settings.siteName }}</span>
          </router-link>
        </div>
        <div class="main-header-info">
          <div class="top-header">
            <ul class="top-left">
              <li v-if="settings.phone">
                <i class="fa-regular fa-phone"></i>
                <a :href="`tel:${settings.phone}`">{{ settings.phone }}</a>
              </li>
              <li v-if="settings.contactEmail">
                <i class="fa-regular fa-envelope-dot"></i>
                <a :href="`mailto:${settings.contactEmail}`">{{ settings.contactEmail }}</a>
              </li>
            </ul>
            <div class="top-right">
              <ul class="top-header-nav">
                <li><router-link to="/faq">Help</router-link></li>
                <li><router-link to="/contact">Support</router-link></li>
                <li><router-link to="/faq">FAQ</router-link></li>
              </ul>
              <ul class="header-social-share">
                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-tiktok"></i></a></li>
              </ul>
            </div>
          </div>

          <div class="header-menu-wrap">
            <ul class="nav-menu">
              <li><router-link to="/">Home</router-link></li>
              <li>
                <router-link to="/company">Company</router-link>
                <ul>
                  <li><router-link to="/about">About Us</router-link></li>
                  <li><router-link to="/company">Overview</router-link></li>
                  <li><router-link to="/team">Our Team</router-link></li>
                  <li><router-link to="/testimonials">Testimonials</router-link></li>
                </ul>
              </li>
              <li>
                <a href="#">Services</a>
                <ul>
                  <li><router-link to="/services/logistics">Logistic Service</router-link></li>
                  <li><router-link to="/services/transport">Transport Service</router-link></li>
                  <li><router-link to="/services/details">Service Details</router-link></li>
                </ul>
              </li>
              <li>
                <a href="#">Business</a>
                <ul>
                  <li><router-link to="/business/land-transport">Land Transport</router-link></li>
                  <li><router-link to="/business/air-freight">Air Freight</router-link></li>
                  <li><router-link to="/business/ocean-freight">Ocean Freight</router-link></li>
                  <li><router-link to="/business/intermodal">Intermodal Solutions</router-link></li>
                  <li><router-link to="/business/project-logistics">Project Logistics</router-link></li>
                  <li><router-link to="/business/carrier">Carrier Business</router-link></li>
                  <li><router-link to="/business/cargo-insurance">Cargo Insurance</router-link></li>
                </ul>
              </li>
              <li>
                <a href="#">Pages</a>
                <ul>
                  <li><router-link to="/faq">Help &amp; FAQs</router-link></li>
                  <li><router-link to="/pricing">Plans &amp; Pricing</router-link></li>
                </ul>
              </li>
              <li><router-link to="/blog">Blog</router-link></li>
              <li><router-link to="/contact">Contact</router-link></li>
            </ul>
            <div class="menu-right-item">
              <div class="menu-action-btn dl-search-icon" @click="toggleSearch">
                <i class="fa-sharp fa-light fa-magnifying-glass"></i>
              </div>
              <div class="mobile-menu-icon" @click="toggleMobileMenu">
                <i class="fa-regular fa-ellipsis-vertical"></i>
              </div>
              <!-- Complaints / Compliance button -->
              <button class="complaint-trigger-btn d-none d-lg-flex d-md-flex" @click="showModal = true" title="Complaints &amp; Compliance">
                <i class="fa-regular fa-shield-exclamation"></i>
                <span>Complaints</span>
              </button>
              <a href="/track" class="default-btn d-none d-lg-block d-md-block">
                <i class="fa-regular fa-truck-fast"></i>Track Your Order
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Search Box -->
  <div id="popup-search-box" :class="{ toggled: searchOpen }">
    <div class="box-inner-wrap d-flex align-items-center">
      <form id="form" @submit.prevent role="search">
        <input id="popup-search" type="text" name="s" placeholder="Type keywords here...">
        <button type="button"><i class="fa-sharp fa-light fa-magnifying-glass"></i></button>
      </form>
      <div class="search-close" @click="closeSearch"><i class="fa-regular fa-xmark"></i></div>
    </div>
  </div>
  <div id="searchbox-overlay" @click="closeSearch"></div>

  <!-- Mobile Nav -->
  <div class="mobile-navigation-menu" :class="{ 'open-mobile-menu': mobileOpen }">
    <button id="mobile-menu-close" @click="closeMobileMenu"><i class="fa-regular fa-xmark"></i></button>
    <ul class="nav-menu">
      <li><router-link to="/" @click="closeMobileMenu">Home</router-link></li>
      <li class="dropdown_menu">
        <a href="#" @click.prevent="toggleDropdown('company')">Company</a>
        <span class="dropdown-plus" :class="{ 'dropdown-open': openDropdown === 'company' }" @click.prevent="toggleDropdown('company')"></span>
        <ul v-show="openDropdown === 'company'">
          <li><router-link to="/about" @click="closeMobileMenu">About Us</router-link></li>
          <li><router-link to="/company" @click="closeMobileMenu">Overview</router-link></li>
          <li><router-link to="/team" @click="closeMobileMenu">Our Team</router-link></li>
          <li><router-link to="/testimonials" @click="closeMobileMenu">Testimonials</router-link></li>
        </ul>
      </li>
      <li class="dropdown_menu">
        <a href="#" @click.prevent="toggleDropdown('services')">Services</a>
        <span class="dropdown-plus" :class="{ 'dropdown-open': openDropdown === 'services' }" @click.prevent="toggleDropdown('services')"></span>
        <ul v-show="openDropdown === 'services'">
          <li><router-link to="/services/logistics" @click="closeMobileMenu">Logistic Service</router-link></li>
          <li><router-link to="/services/transport" @click="closeMobileMenu">Transport Service</router-link></li>
          <li><router-link to="/services/details" @click="closeMobileMenu">Service Details</router-link></li>
        </ul>
      </li>
      <li class="dropdown_menu">
        <a href="#" @click.prevent="toggleDropdown('business')">Business</a>
        <span class="dropdown-plus" :class="{ 'dropdown-open': openDropdown === 'business' }" @click.prevent="toggleDropdown('business')"></span>
        <ul v-show="openDropdown === 'business'">
          <li><router-link to="/business/land-transport" @click="closeMobileMenu">Land Transport</router-link></li>
          <li><router-link to="/business/air-freight" @click="closeMobileMenu">Air Freight</router-link></li>
          <li><router-link to="/business/ocean-freight" @click="closeMobileMenu">Ocean Freight</router-link></li>
          <li><router-link to="/business/intermodal" @click="closeMobileMenu">Intermodal Solutions</router-link></li>
          <li><router-link to="/business/project-logistics" @click="closeMobileMenu">Project Logistics</router-link></li>
          <li><router-link to="/business/carrier" @click="closeMobileMenu">Carrier Business</router-link></li>
          <li><router-link to="/business/cargo-insurance" @click="closeMobileMenu">Cargo Insurance</router-link></li>
        </ul>
      </li>
      <li class="dropdown_menu">
        <a href="#" @click.prevent="toggleDropdown('pages')">Pages</a>
        <span class="dropdown-plus" :class="{ 'dropdown-open': openDropdown === 'pages' }" @click.prevent="toggleDropdown('pages')"></span>
        <ul v-show="openDropdown === 'pages'">
          <li><router-link to="/faq" @click="closeMobileMenu">Help &amp; FAQs</router-link></li>
          <li><router-link to="/pricing" @click="closeMobileMenu">Plans &amp; Pricing</router-link></li>
        </ul>
      </li>
      <li><router-link to="/blog" @click="closeMobileMenu">Blog</router-link></li>
      <li><router-link to="/contact" @click="closeMobileMenu">Contact</router-link></li>
      <li>
        <a href="#" @click.prevent="showModal = true; closeMobileMenu()">
          <i class="fa-regular fa-shield-exclamation"></i> Complaints
        </a>
      </li>
      <li><a href="/track" @click="closeMobileMenu">Track Your Order</a></li>
    </ul>
  </div>

  <!-- Complaints / Compliance Modal -->
  <ComplaintsModal :show="showModal" @close="showModal = false" />
</template>

<script setup>
import { ref, watch } from 'vue'
import { useRoute } from 'vue-router'
import { useSettingsStore } from '../../stores/useSettingsStore.js'
import ComplaintsModal from './ComplaintsModal.vue'

const route       = useRoute()
const settings    = useSettingsStore()
const showModal   = ref(false)
const searchOpen  = ref(false)
const mobileOpen  = ref(false)
const openDropdown = ref(null)

function toggleSearch() {
  searchOpen.value = !searchOpen.value
  if (searchOpen.value) {
    document.body.classList.add('open-search-box')
    document.getElementById('popup-search')?.focus()
  } else {
    document.body.classList.remove('open-search-box')
  }
}

function closeSearch() {
  searchOpen.value = false
  document.body.classList.remove('open-search-box')
}

function toggleMobileMenu() { mobileOpen.value = !mobileOpen.value }
function closeMobileMenu()   { mobileOpen.value = false; openDropdown.value = null }
function toggleDropdown(key) { openDropdown.value = openDropdown.value === key ? null : key }

watch(route, () => { closeSearch(); closeMobileMenu() })
</script>

<style scoped>
/* ── Complaints trigger button ─────────────────────────────────────────── */
.complaint-trigger-btn {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 8px 16px;
  background: linear-gradient(135deg, #e53935, #b71c1c);
  color: #fff;
  border: none;
  border-radius: 6px;
  font-size: 0.82rem;
  font-weight: 700;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  cursor: pointer;
  margin-right: 10px;
  white-space: nowrap;
  position: relative;
  animation: complaint-shake 4s ease-in-out infinite;
  box-shadow: 0 0 0 0 rgba(229, 57, 53, 0.7);
  transition: background 0.2s, transform 0.15s;
}

.complaint-trigger-btn:hover {
  background: linear-gradient(135deg, #c62828, #8b0000);
  transform: translateY(-1px);
  animation: none;
  box-shadow: 0 6px 20px rgba(229, 57, 53, 0.45);
}

.complaint-trigger-btn i {
  font-size: 0.95rem;
}

/* Glow pulse */
@keyframes complaint-glow {
  0%, 100% { box-shadow: 0 0 0 0 rgba(229, 57, 53, 0.7); }
  50%       { box-shadow: 0 0 0 10px rgba(229, 57, 53, 0); }
}

/* Shake */
@keyframes complaint-shake {
  0%,  88%, 100% { transform: translateX(0); box-shadow: 0 0 8px 2px rgba(229,57,53,0.5); }
  90%             { transform: translateX(-3px); }
  92%             { transform: translateX(3px); }
  94%             { transform: translateX(-3px); }
  96%             { transform: translateX(3px); }
  98%             { transform: translateX(0); }
}
</style>
