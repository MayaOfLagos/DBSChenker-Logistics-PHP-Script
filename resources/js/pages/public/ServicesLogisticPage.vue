<template>
  <PublicLayout>
    <section class="page-header">
      <div class="container">
        <div class="page-header-info">
          <h4>Logistic Services</h4>
          <h2>Our global <br>logistic <span>services!</span></h2>
          <p>Comprehensive logistics solutions tailored to your business needs worldwide.</p>
        </div>
      </div>
    </section>

    <section class="service-section bg-grey padding">
      <div class="map-pattern"></div>
      <div class="container">
        <div class="section-heading text-center mb-40">
          <h3 class="sub-heading is-border border-anim">Our Logistics Services!<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Offering Cost Efficient<br>Transport <span class="hl">Shipping!</span></h2>
          <p class="text-anim" data-effect="fade-in-bottom" data-ease="power4.out">DB Schenker specializes in managing the transportation,<br>storage and distribution of goods.</p>
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
          <div class="col-lg-4"><div class="promo-item"><i class="logis logis-airplane-flying"></i><div class="promo-content"><h3>Air Freight</h3><p>Express air cargo delivery.</p></div></div></div>
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
  { id: 1, title: 'Road Freight', icon: 'logis logis-truck-2', img: '/assets/img/services/transport.jpg', desc: 'Reliable road freight solutions for domestic and cross-border transportation of all cargo sizes.', delay: '100ms' },
  { id: 2, title: 'Ocean Freight', icon: 'logis logis-cruise', img: '/assets/img/projects/ocean-freight.jpg', desc: 'FCL and LCL ocean freight connecting major ports globally with reliable schedules.', delay: '300ms' },
  { id: 3, title: 'Air Freight', icon: 'logis logis-airplane-flying', img: '/assets/img/services/careers.jpg', desc: 'Express air cargo solutions for time-sensitive and high-value global shipments.', delay: '500ms' },
  { id: 4, title: 'Warehousing', icon: 'logis logis-loader', img: '/assets/img/services/contract-logistics.jpg', desc: 'State-of-the-art warehousing facilities with inventory management systems.', delay: '100ms' },
  { id: 5, title: 'Supply Chain', icon: 'logis logis-worldwide', img: '/assets/img/services/supply-chain.jpg', desc: 'End-to-end supply chain solutions optimized for efficiency and cost savings.', delay: '300ms' },
  { id: 6, title: 'Customs Brokerage', icon: 'logis logis-map-1', img: '/assets/img/projects/port-terminal.jpg', desc: 'Expert customs clearance and compliance services for smooth border crossings.', delay: '500ms' },
]
</script>
