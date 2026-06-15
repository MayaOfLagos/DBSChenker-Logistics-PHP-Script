<template>
  <PublicLayout>
    <section class="page-header">
      <div class="container">
        <div class="page-header-info">
          <h4>Service Details</h4>
          <h2>Road freight<br><span>service details!</span></h2>
          <p>Learn more about our comprehensive road freight services and capabilities.</p>
        </div>
      </div>
    </section>

    <section class="blog-section padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 sm-padding">
            <div class="service-details-wrap row-gap">
              <div class="post-thumb mb-30">
                <img src="/assets/img/content-bg-3.jpg" alt="service">
              </div>
              <h2>Road Freight Services</h2>
              <p>DB Schenker's road freight division offers a comprehensive range of transportation solutions designed to meet the evolving needs of our clients. From full truckload services to complex multi-stop deliveries, our experienced team ensures your cargo arrives on time and in perfect condition.</p>
              <div class="row gy-4 my-3">
                <div class="col-md-6">
                  <div class="service-item">
                    <div class="service-content">
                      <div class="service-icon"><i class="logis logis-truck-2"></i></div>
                      <h3>Full Truckload</h3>
                      <p>Dedicated transport for shipments requiring the full capacity of a truck.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="service-item">
                    <div class="service-content">
                      <div class="service-icon"><i class="logis logis-truck-3"></i></div>
                      <h3>Partial Load</h3>
                      <p>Economical solutions for smaller shipments sharing trailer space.</p>
                    </div>
                  </div>
                </div>
              </div>
              <ul class="check-list mb-20">
                <li><i class="fa-solid fa-check"></i>Real-time GPS tracking on all vehicles</li>
                <li><i class="fa-solid fa-check"></i>Experienced and certified drivers</li>
                <li><i class="fa-solid fa-check"></i>Full cargo insurance coverage</li>
                <li><i class="fa-solid fa-check"></i>Temperature-controlled options available</li>
                <li><i class="fa-solid fa-check"></i>24/7 customer support</li>
              </ul>
              <p>Our road network connects all major economic centers across Israel and beyond, ensuring reliable transit times and competitive rates for all cargo types.</p>
            </div>
          </div>
          <div class="col-lg-4 sm-padding">
            <div class="sidebar-widget">
              <div class="widget-title"><h3>Our Services</h3></div>
              <ul class="footer-links">
                <li><router-link to="/services/logistics">Road Freight</router-link></li>
                <li><router-link to="/services/logistics">Ocean Freight</router-link></li>
                <li><router-link to="/services/logistics">Air Freight</router-link></li>
                <li><router-link to="/services/logistics">Warehousing</router-link></li>
                <li><router-link to="/services/logistics">Supply Chain</router-link></li>
                <li><router-link to="/services/logistics">Customs Brokerage</router-link></li>
              </ul>
            </div>
            <div class="sidebar-widget">
              <div class="widget-title"><h3>Contact Us</h3></div>
              <ul class="contact-info-list">
                <li v-if="settings.phone"><i class="fa-light fa-phone-volume"></i><h3><a :href="`tel:${settings.phone}`" style="color:inherit;text-decoration:none;">{{ settings.phone }}</a></h3></li>
                <li v-if="settings.contactEmail"><i class="fa-light fa-envelope-open-text"></i><h3><a :href="`mailto:${settings.contactEmail}`" style="color:inherit;text-decoration:none;">{{ settings.contactEmail }}</a></h3></li>
              </ul>
              <router-link to="/contact" class="default-btn mt-20 d-block text-center">Get A Quote</router-link>
            </div>
            <div class="sidebar-widget sidebar-banner">
              <router-link to="/contact"><img src="/assets/img/db-schenker-insights-corporate-sustainability-stage.webp" alt="banner"></router-link>
            </div>
          </div>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import PublicLayout from '../../layouts/PublicLayout.vue'
import { useTemplateInit } from '../../composables/useTemplateInit.js'
import { useSettingsStore } from '../../stores/useSettingsStore.js'

useTemplateInit()
const settings = useSettingsStore()
</script>
