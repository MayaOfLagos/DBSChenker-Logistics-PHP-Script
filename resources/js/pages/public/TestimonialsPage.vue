<template>
  <PublicLayout>
    <section class="page-header">
      <div class="container">
        <div class="page-header-info">
          <h4>Testimonials</h4>
          <h2>Honest Reviews from<br>Real <span>Customers!</span></h2>
          <p>See what our clients say about DB Schenker's logistics and transportation services.</p>
        </div>
      </div>
    </section>

    <section class="testimonial-section padding">
      <div class="map-pattern"></div>
      <div class="container">
        <div class="row gy-5">
          <div class="col-md-6" v-for="testi in testimonials" :key="testi.id">
            <div class="testimonial-item">
              <div class="testi-thumb"><img :src="testi.img" :alt="testi.name" loading="lazy"></div>
              <div class="testi-content">
                <div class="client-info"><h3>{{ testi.name }} <span>{{ testi.role }}</span></h3></div>
                <p>{{ testi.text }}</p>
                <ul class="rattings">
                  <li v-for="n in testi.stars" :key="n"><i class="fa-sharp fa-solid fa-star"></i></li>
                </ul>
                <div class="quote-icon"><i class="fa-sharp fa-solid fa-quote-right"></i></div>
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
import { testimonials } from '../../data/testimonials.js'

useTemplateInit()
</script>
