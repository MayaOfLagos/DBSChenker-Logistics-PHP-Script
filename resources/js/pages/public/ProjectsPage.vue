<template>
  <PublicLayout>
    <section class="page-header">
      <div class="container">
        <div class="page-header-info">
          <h4>Our Projects</h4>
          <h2>Delivering logistics <br><span>excellence!</span></h2>
          <p>Explore our portfolio of successful logistics and transportation projects worldwide.</p>
        </div>
      </div>
    </section>

    <section class="projects-section padding">
      <div class="container">
        <div class="row gy-4">
          <div class="col-md-4 col-sm-6" v-for="project in projects" :key="project.id">
            <div class="project-item wow fade-in-bottom" :data-wow-delay="project.delay">
              <div class="project-thumb project-view">
                <a class="venobox" :href="project.img" data-gall="projects"><img :src="project.img" alt="img"></a>
              </div>
              <div class="project-content">
                <a href="#" class="category">{{ project.category }}</a>
                <h3><router-link to="/projects/details">{{ project.title }}</router-link></h3>
              </div>
            </div>
          </div>
        </div>
        <ul class="pagination-wrap text-center mt-40">
          <li><a href="#"><i class="fa-regular fa-arrow-left"></i></a></li>
          <li><a href="#" :class="{ active: currentPage === 1 }" @click.prevent="currentPage = 1">1</a></li>
          <li><a href="#" :class="{ active: currentPage === 2 }" @click.prevent="currentPage = 2">2</a></li>
          <li><a href="#" :class="{ active: currentPage === 3 }" @click.prevent="currentPage = 3">3</a></li>
          <li><a href="#"><i class="fa-regular fa-arrow-right"></i></a></li>
        </ul>
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
import { ref } from 'vue'
import PublicLayout from '../../layouts/PublicLayout.vue'
import { useTemplateInit } from '../../composables/useTemplateInit.js'

useTemplateInit()

const currentPage = ref(1)

const projects = [
  { id: 1, title: 'Port Terminal Container Management', category: 'Ocean Freight', img: '/assets/img/projects/port-terminal.jpg', delay: '200ms' },
  { id: 2, title: 'Cross-Country Fleet Operations', category: 'Road Freight', img: '/assets/img/projects/fleet-operations.jpg', delay: '400ms' },
  { id: 3, title: 'Multi-Modal Ocean Freight Hub', category: 'Ocean Freight', img: '/assets/img/projects/ocean-freight.jpg', delay: '600ms' },
  { id: 4, title: 'Last-Mile Road Freight Delivery', category: 'Road Freight', img: '/assets/img/projects/road-freight.jpg', delay: '700ms' },
  { id: 5, title: 'Global Container Logistics Network', category: 'Logistics', img: '/assets/img/projects/container-logistics.jpg', delay: '800ms' },
  { id: 6, title: 'Contract Logistics & Warehousing Solutions', category: 'Warehousing', img: '/assets/img/services/contract-logistics.jpg', delay: '1000ms' },
]
</script>
