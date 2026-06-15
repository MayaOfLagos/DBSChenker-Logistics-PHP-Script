<template>
  <PublicLayout>
    <section class="page-header">
      <div class="container">
        <div class="page-header-info">
          <h4>Company</h4>
          <h2>About DB Schenker <br><span>Israel HQ!</span></h2>
          <p>DB Schenker Israel — your trusted logistics partner in the Middle East region.</p>
        </div>
      </div>
    </section>

    <section class="about-section padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <div class="about-img-wrap mt-50">
              <img class="wow fade-in-left" data-wow-delay="100ms" src="/assets/img/content-bg-2.jpg" alt="img">
              <img class="wow fade-in-bottom" data-wow-delay="300ms" src="/assets/img/projects/port-terminal.jpg" alt="img">
              <img src="/assets/img/forklift.png" alt="img">
              <div class="about-img-info">Since 1972</div>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="section-heading mb-40">
              <h3 class="sub-heading is-border border-anim">DB Schenker Israel<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
              <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Your Regional Logistics<br><span class="hl">Headquarters!</span></h2>
              <p class="text-anim" data-effect="fade-in-bottom" data-ease="power4.out">DB Schenker Israel serves as the regional headquarters for the Middle East, providing world-class freight forwarding, contract logistics, and supply chain solutions backed by DB Schenker's global network.</p>
            </div>
            <ul class="promo-list mb-30">
              <li class="wow fade-in-bottom" data-wow-delay="100ms">
                <i class="logis logis-map-1"></i>
                <div class="promo-content">
                  <h3>Regional Coverage</h3>
                  <p>Full logistics coverage across Israel and the wider Middle East region.</p>
                </div>
              </li>
              <li class="wow fade-in-bottom" data-wow-delay="300ms">
                <i class="logis logis-worldwide"></i>
                <div class="promo-content">
                  <h3>Global Network</h3>
                  <p>Connected to DB Schenker's global network spanning 130+ countries.</p>
                </div>
              </li>
            </ul>
            <ul class="check-list mb-20 wow fade-in-bottom" data-wow-delay="100ms">
              <li><i class="fa-solid fa-check"></i>Air, ocean and road freight services</li>
              <li><i class="fa-solid fa-check"></i>Contract logistics and warehousing solutions</li>
              <li><i class="fa-solid fa-check"></i>Customs clearance and trade compliance</li>
              <li><i class="fa-solid fa-check"></i>Dedicated account management team</li>
            </ul>
            <div class="btn-group wow fade-in-bottom" data-wow-delay="300ms">
              <router-link to="/contact" class="default-btn">Contact Us</router-link>
              <div class="call-info">
                <i class="fa-light fa-phone"></i>
                <h3>Have Any Questions? <span><a v-if="settings.phone" :href="`tel:${settings.phone}`" style="color:inherit;text-decoration:none;">{{ settings.phone }}</a></span></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="content-features bg-dark padding">
      <div class="map-pattern"></div>
      <div class="container">
        <div class="counter-wrap">
          <div class="counter-item wow fade-in-bottom" data-wow-delay="200ms" v-for="stat in stats" :key="stat.id">
            <div class="counter-icon"><i :class="stat.icon"></i></div>
            <div class="counter-content">
              <h3 v-if="stat.live" class="live-stat-wrap">
                <span class="live-stat">{{ fmtDeliveries(deliveryCount) }}</span><span class="stat-suffix">+</span>
              </h3>
              <h3 v-else>
                <span class="odometer" :data-count="stat.count">00</span><span class="stat-suffix">{{ stat.suffix }}</span>
              </h3>
              <h4>{{ stat.label }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <section class="cta-section padding-bottom">
      <div class="container">
        <div class="row cta-wrapper gx-0">
          <div class="col-lg-6">
            <div class="section-heading white">
              <h3 class="sub-heading is-border border-anim">Trusted Global Shipping!<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
              <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Ensure Safe Transportation<br>Fast Delivery <span class="hl">Service!</span></h2>
              <router-link to="/contact" class="default-btn wow fade-in-bottom" data-wow-delay="200ms">Book Your Parcel</router-link>
            </div>
          </div>
          <div class="cta-men wow fade-in-bottom" data-wow-delay="200ms"></div>
        </div>
        <div class="row promo-item-wrapper gx-0">
          <div class="col-lg-4"><div class="promo-item"><i class="logis logis-truck-3"></i><div class="promo-content"><h3>Road Freight</h3><p>Reliable road freight solutions.</p></div></div></div>
          <div class="col-lg-4"><div class="promo-item"><i class="logis logis-cruise"></i><div class="promo-content"><h3>Ocean Freight</h3><p>Global ocean freight services.</p></div></div></div>
          <div class="col-lg-4"><div class="promo-item"><i class="logis logis-airplane-flying"></i><div class="promo-content"><h3>Air Freight</h3><p>Express air cargo solutions.</p></div></div></div>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import PublicLayout from '../../layouts/PublicLayout.vue'
import { useTemplateInit } from '../../composables/useTemplateInit.js'
import { useSettingsStore } from '../../stores/useSettingsStore.js'
import { useLiveStats } from '../../composables/useLiveStats.js'

useTemplateInit()
const settings = useSettingsStore()
const { stats, deliveryCount, fmtDeliveries } = useLiveStats()
</script>

<style scoped>
.live-stat-wrap { display: inline-flex; align-items: baseline; gap: 2px; }
.live-stat { font-size: inherit; font-weight: inherit; color: inherit; font-family: inherit; }
.stat-suffix { font-size: 0.75em; font-weight: 700; opacity: 0.85; }
</style>
