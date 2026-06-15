<template>
  <PublicLayout>
    <section class="page-header">
      <div class="container">
        <div class="page-header-info">
          <h4>Our Team</h4>
          <h2>Meet the dedicated <br><span>team!</span></h2>
          <p>Our experienced logistics professionals are committed to delivering excellence.</p>
        </div>
      </div>
    </section>

    <section class="team-section padding">
      <div class="container">
        <div class="section-heading text-center mb-40">
          <h3 class="sub-heading is-border border-anim">Our Logistics Experts<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Deliver Fast <span class="hl">Efficient</span><br>Transportation!</h2>
          <p class="text-anim" data-effect="fade-in-bottom" data-ease="power4.out">Our team of logistics experts works tirelessly to ensure every shipment arrives on time.</p>
        </div>
        <div class="row gy-lg-0 gy-4">
          <div class="col-lg-3 col-md-6" v-for="member in team" :key="member.id">
            <div class="team-item wow fade-in-bottom" :data-wow-delay="member.delay">
              <div class="team-thumb">
                <img :src="member.img" alt="thumb">
                <ul class="team-social">
                  <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                  <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                  <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                  <li><a href="#"><i class="fa-brands fa-tiktok"></i></a></li>
                </ul>
              </div>
              <div class="team-content">
                <h4 class="position">{{ member.role }}</h4>
                <h3><router-link to="/team/details">{{ member.name }}</router-link></h3>
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

const team = [
  { id: 1, name: 'Land Transport', role: 'Freight Experts', img: '/assets/img/team/land-transport.jpg', delay: '100ms' },
  { id: 2, name: 'Air Freight', role: 'Aviation Specialists', img: '/assets/img/team/air-freight.jpg', delay: '300ms' },
  { id: 3, name: 'Ocean Freight', role: 'Maritime Experts', img: '/assets/img/team/ocean-freight.jpg', delay: '500ms' },
  { id: 4, name: 'Contract Logistics', role: 'Supply Chain Team', img: '/assets/img/team/contract-logistics.jpg', delay: '700ms' },
  { id: 5, name: 'Fairs & Events Logistics', role: 'Special Cargo Experts', img: '/assets/img/team/fairs-events.jpg', delay: '100ms' },
  { id: 6, name: 'Road & Land Freight', role: 'Transport Specialists', img: '/assets/img/team/land-transport.jpg', delay: '300ms' },
  { id: 7, name: 'Supply Chain Management', role: 'Operations Team', img: '/assets/img/team/contract-logistics.jpg', delay: '500ms' },
  { id: 8, name: 'Digital Logistics', role: 'Innovation Experts', img: '/assets/img/team/air-freight.jpg', delay: '700ms' },
]
</script>
