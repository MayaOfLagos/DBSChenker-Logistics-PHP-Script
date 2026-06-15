<template>
  <PublicLayout>
    <section class="page-header">
      <div class="container">
        <div class="page-header-info">
          <h4>Team Details</h4>
          <h2>Meet our logistics <br><span>professional!</span></h2>
          <p>Dedicated experts committed to delivering world-class logistics services.</p>
        </div>
      </div>
    </section>

    <section class="team-section padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="team-details-thumb wow fade-in-left" data-wow-delay="100ms">
              <img src="/assets/img/team/land-transport.jpg" alt="team member">
              <ul class="team-social mt-20">
                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="team-details-content wow fade-in-right" data-wow-delay="200ms">
              <div class="section-heading mb-30">
                <h3 class="sub-heading is-border border-anim">Fleet Supervisor<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
                <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Phillip <span class="hl">Hancock</span></h2>
              </div>
              <p>Phillip brings over 15 years of experience in fleet management and logistics operations. As Fleet Supervisor at DB Schenker Israel, he oversees a fleet of 50+ vehicles ensuring on-time delivery performance and driver safety across all routes.</p>
              <p>His expertise spans route optimization, vehicle maintenance scheduling, regulatory compliance and team leadership. Phillip is passionate about integrating technology into fleet operations for maximum efficiency.</p>
              <ul class="check-list mb-30 mt-20">
                <li><i class="fa-solid fa-check"></i>15+ years in logistics and fleet management</li>
                <li><i class="fa-solid fa-check"></i>Certified logistics professional (CLP)</li>
                <li><i class="fa-solid fa-check"></i>Specialist in route optimization and GPS tracking</li>
                <li><i class="fa-solid fa-check"></i>Led 500+ successful transport operations</li>
              </ul>
              <div class="btn-group">
                <router-link to="/contact" class="default-btn">Contact</router-link>
                <router-link to="/team" class="default-btn" style="background: transparent; border: 2px solid #e31e24; color: #e31e24; margin-left: 10px;">Back to Team</router-link>
              </div>
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
</script>
