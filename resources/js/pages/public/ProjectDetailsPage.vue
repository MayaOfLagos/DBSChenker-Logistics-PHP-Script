<template>
  <PublicLayout>
    <section class="page-header">
      <div class="container">
        <div class="page-header-info">
          <h4>Project Details</h4>
          <h2>Freight Wave <br><span>logistics project!</span></h2>
          <p>A successful multi-modal logistics project delivering complex cargo across borders.</p>
        </div>
      </div>
    </section>

    <section class="blog-section padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 sm-padding">
            <div class="project-details-wrap row-gap">
              <div class="post-thumb mb-30">
                <img src="/assets/img/content-bg-4.jpg" alt="project">
              </div>
              <h2>Freight Wave — Multi-Modal Logistics Project</h2>
              <p>The Freight Wave project involved coordinating a complex multi-modal supply chain for a major industrial client, moving heavy equipment from manufacturing facilities in Germany to a construction site in Israel. The operation required meticulous planning across air, sea and road transport modes.</p>
              <div class="row gy-4 my-3">
                <div class="col-md-6">
                  <div class="project-info-item">
                    <h4>Client</h4>
                    <p>Industrial Manufacturing Corp</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="project-info-item">
                    <h4>Category</h4>
                    <p>Multi-Modal Logistics</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="project-info-item">
                    <h4>Duration</h4>
                    <p>6 Weeks</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="project-info-item">
                    <h4>Status</h4>
                    <p>Completed Successfully</p>
                  </div>
                </div>
              </div>
              <p>DB Schenker coordinated the complete logistics chain from origin to destination, managing all documentation, customs clearance, and last-mile delivery. The project was completed on schedule and within budget.</p>
              <ul class="check-list mb-20">
                <li><i class="fa-solid fa-check"></i>Air freight from Germany to Tel Aviv</li>
                <li><i class="fa-solid fa-check"></i>Port handling and customs clearance</li>
                <li><i class="fa-solid fa-check"></i>Specialized heavy transport to site</li>
                <li><i class="fa-solid fa-check"></i>Real-time tracking throughout</li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 sm-padding">
            <div class="sidebar-widget">
              <div class="widget-title"><h3>Related Projects</h3></div>
              <ul class="thumb-post">
                <li v-for="p in relatedProjects" :key="p.id">
                  <div class="thumb"><img :src="p.img" alt="thumb"></div>
                  <div class="thumb-post-info">
                    <h3><router-link to="/projects/details">{{ p.title }}</router-link></h3>
                    <a href="#" class="date">{{ p.category }}</a>
                  </div>
                </li>
              </ul>
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

useTemplateInit()

const relatedProjects = [
  { id: 1, title: 'Cross-Country Fleet Operations', img: '/assets/img/projects/fleet-operations.jpg', category: 'Road Freight' },
  { id: 2, title: 'Multi-Modal Ocean Freight Hub', img: '/assets/img/projects/ocean-freight.jpg', category: 'Ocean Freight' },
  { id: 3, title: 'Last-Mile Road Freight Delivery', img: '/assets/img/projects/road-freight.jpg', category: 'Road Freight' },
]
</script>
