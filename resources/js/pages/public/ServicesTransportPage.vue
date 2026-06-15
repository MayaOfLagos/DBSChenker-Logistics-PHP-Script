<template>
  <PublicLayout>
    <section class="page-header">
      <div class="container">
        <div class="page-header-info">
          <h4>Transport Services</h4>
          <h2>Global transport<br><span>solutions!</span></h2>
          <p>Comprehensive transportation services connecting your business to the world.</p>
        </div>
      </div>
    </section>

    <section class="service-section padding">
      <div class="map-pattern"></div>
      <div class="container">
        <div class="section-heading text-center mb-40">
          <h3 class="sub-heading is-border border-anim">Transport Services!<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Reliable Multi-Modal<br><span class="hl">Transportation!</span></h2>
          <p class="text-anim" data-effect="fade-in-bottom" data-ease="power4.out">End-to-end transportation solutions with full visibility and on-time performance.</p>
        </div>
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6" v-for="service in services" :key="service.id">
            <div class="service-item wow fade-in-bottom" :data-wow-delay="service.delay">
              <div class="service-thumb"><img :src="service.img" alt="thumb"></div>
              <div class="service-content">
                <div class="service-icon"><i :class="service.icon"></i></div>
                <h3><router-link to="/services/details">{{ service.title }}</router-link></h3>
                <p>{{ service.desc }}</p>
                <router-link class="read-more" to="/services/details">Read More</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

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

useTemplateInit()

const services = [
  { id: 1, title: 'Full Truckload (FTL)', icon: 'logis logis-truck-2', img: '/assets/img/services/transport.jpg', desc: 'Dedicated full truckload transport for large shipments across any distance.', delay: '100ms' },
  { id: 2, title: 'Less Than Truckload (LTL)', icon: 'logis logis-truck-3', img: '/assets/img/projects/fleet-operations.jpg', desc: 'Cost-effective LTL transport — share trailer space and save on shipping costs.', delay: '300ms' },
  { id: 3, title: 'Intermodal Transport', icon: 'logis logis-loader', img: '/assets/img/projects/container-logistics.jpg', desc: 'Seamless intermodal solutions combining road, rail and sea transport modes.', delay: '500ms' },
  { id: 4, title: 'Temperature Controlled', icon: 'logis logis-package', img: '/assets/img/services/contract-logistics.jpg', desc: 'Refrigerated transport for pharmaceuticals, food and temperature-sensitive cargo.', delay: '100ms' },
  { id: 5, title: 'Hazardous Materials', icon: 'logis logis-package-1', img: '/assets/img/projects/road-freight.jpg', desc: 'Certified transport of hazardous materials with full regulatory compliance.', delay: '300ms' },
  { id: 6, title: 'Project Cargo', icon: 'logis logis-cruise', img: '/assets/img/projects/ocean-freight.jpg', desc: 'Specialized handling of oversized and project cargo for complex movements.', delay: '500ms' },
]
</script>
