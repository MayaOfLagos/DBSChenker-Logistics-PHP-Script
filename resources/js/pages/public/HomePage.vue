<template>
  <PublicLayout>
    <!-- Hero Slider -->
    <div class="slider-section">
      <div class="main-slider">
        <div class="swiper-wrapper">
          <div class="swiper-slide" v-for="slide in slides" :key="slide.id">
            <div class="slider-img-wrap">
              <div class="slider-img">
                <!-- Video only on first slide; other slides use the static fallback -->
                <video
                  v-if="slide.id === 1"
                  class="slider-hero-video"
                  :class="{ 'slider-hero-video--visible': videoReady && !videoFailed, 'slider-hero-video--failed': videoFailed }"
                  autoplay
                  muted
                  loop
                  playsinline
                  @playing="videoReady = true"
                  @error="onVideoError"
                ></video>
                <img
                  src="/assets/img/slider-bg.jpg"
                  alt=""
                  class="slider-hero-fallback"
                  :class="{ 'slider-hero-fallback--hidden': slide.id === 1 && videoReady && !videoFailed }"
                >
              </div>
              <div class="slider-road"></div>
              <div class="corner-shape" data-animation="fade-in-left" data-duration="1.5s" data-delay="0.3s"></div>
              <div class="container-img" data-animation="fade-in-top" data-duration="1.5s" data-delay="0.8s"></div>
              <div class="slider-truck" data-animation="truck-animation-right" data-duration="1.5s" data-delay="0.5s"></div>
              <div class="slider-badge" data-animation="bounce-in" data-duration="1.5s" data-delay="1s"></div>
            </div>
            <div class="slider-content-wrap d-flex align-items-center text-left">
              <div class="container">
                <div class="slider-content">
                  <div class="slider-caption medium">
                    <div class="inner-layer"><div data-animation="fade-in-bottom" data-delay="0.3s">Trusted Path to Global Shipping!</div></div>
                  </div>
                  <div class="slider-caption big">
                    <div class="inner-layer"><div data-animation="fade-in-bottom" data-delay="0.5s" v-html="slide.title"></div></div>
                  </div>
                  <div class="slider-caption small">
                    <div class="inner-layer"><div data-animation="fade-in-bottom" data-delay="0.7s" data-duration="1s">DB Schenker specializes in managing the transportation,<br>storage and distribution of goods worldwide.</div></div>
                  </div>
                  <div class="slider-btn">
                    <a href="/track" class="default-btn" data-animation="fade-in-bottom" data-delay="0.9s">Track Your Parcel</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="slider-pagination"></div>
      </div>
    </div>

    <!-- About Section -->
    <section class="about-section padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <div class="about-img-wrap">
              <img class="wow fade-in-left" data-wow-delay="100ms" src="/assets/img/services/dbschenker-hero01.jpeg" alt="img">
              <img class="wow fade-in-bottom" data-wow-delay="300ms" src="/assets/img/services/dbschenker_hero02.jpeg" alt="img">
              <img src="/assets/img/delivery-man.png" alt="img">
              <div class="about-img-info">Since 1972</div>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="section-heading mb-40">
              <h3 class="sub-heading is-border border-anim">Trusted Path to Global Shipping!<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
              <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Leading Global Logistics &amp;<br>Transportation <span class="hl">Agency!</span></h2>
              <p class="text-anim" data-effect="fade-in-bottom" data-ease="power4.out">DB Schenker is a world-leading provider of integrated logistics services. We specialize in managing transportation, storage, and distribution of goods, offering freight forwarding, warehousing, inventory management, and comprehensive supply chain solutions.</p>
            </div>
            <ul class="promo-list mb-30">
              <li class="wow fade-in-bottom" data-wow-delay="100ms">
                <i class="logis logis-airplane-flying"></i>
                <div class="promo-content">
                  <h3>Real-Time Tracking</h3>
                  <p>Track your shipments in real-time with full visibility at every step.</p>
                </div>
              </li>
              <li class="wow fade-in-bottom" data-wow-delay="300ms">
                <i class="logis logis-worldwide"></i>
                <div class="promo-content">
                  <h3>Global Leaders</h3>
                  <p>Operating in over 130 countries with 76,000 employees worldwide.</p>
                </div>
              </li>
            </ul>
            <ul class="check-list mb-20 wow fade-in-bottom" data-wow-delay="100ms">
              <li><i class="fa-solid fa-check"></i>Efficient management of freight transportation globally</li>
              <li><i class="fa-solid fa-check"></i>Specialized transport options for fragile and perishable goods</li>
              <li><i class="fa-solid fa-check"></i>Real-time tracking of shipments with live updates</li>
            </ul>
            <div class="btn-group wow fade-in-bottom" data-wow-delay="300ms">
              <router-link to="/about" class="default-btn">More About Us</router-link>
              <div class="call-info">
                <i class="fa-light fa-phone"></i>
                <h3>Have Any Questions? <span><a v-if="settings.phone" :href="`tel:${settings.phone}`" style="color:inherit;text-decoration:none;">{{ settings.phone }}</a></span></h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section class="service-section bg-grey padding">
      <div class="map-pattern"></div>
      <div class="container">
        <div class="section-heading text-center mb-40">
          <h3 class="sub-heading is-border border-anim">Our Logistics Services!<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Offering Cost Efficient<br>Transport <span class="hl">Shipping!</span></h2>
          <p class="text-anim" data-effect="fade-in-bottom" data-ease="power4.out">DB Schenker specializes in managing the transportation,<br>storage and distribution of goods.</p>
        </div>

        <!-- 4-per-view swipeable service carousel -->
        <div class="swiper-outside">
          <div class="service-carousel">
            <div class="swiper-wrapper">
              <div class="swiper-slide" v-for="service in services" :key="service.id">
                <div class="service-item">
                  <div class="service-thumb-frame">
                    <img :src="service.img" :alt="service.title" loading="lazy">
                  </div>
                  <div class="service-content">
                    <div class="service-icon"><i :class="service.icon"></i></div>
                    <h3><router-link :to="service.link">{{ service.title }}</router-link></h3>
                    <p>{{ service.desc }}</p>
                    <router-link class="read-more" :to="service.link">Read More</router-link>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-pagination"></div>
          </div>
          <div class="swiper-nav swiper-next service-carousel-next"><i class="fa-regular fa-long-arrow-right"></i></div>
          <div class="swiper-nav swiper-prev service-carousel-prev"><i class="fa-regular fa-long-arrow-left"></i></div>
        </div>
      </div>
    </section>

    <!-- Running Text -->
    <section class="running-text">
      <div class="container">
        <div class="scroller" data-speed="slow">
          <ul class="text-anim scroller__inner">
            <li>Global logistics experts</li>
            <li>Trusted by all over the world</li>
            <li>Cost efficient transportation</li>
            <li>Leading global logistic company</li>
          </ul>
        </div>
      </div>
    </section>

    <!-- Projects Section -->
    <section class="project-section padding">
      <div class="bg-half"></div>
      <div class="container">
        <div class="section-heading-wrap mb-40">
          <div class="section-heading white">
            <h3 class="sub-heading is-border border-anim">Discover Our Projects!<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
            <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Optimizing Routes for<br>Faster <span class="hl">Delivery!</span></h2>
          </div>
          <router-link to="/projects" class="default-btn wow fade-in-right" data-wow-delay="100ms">View All Services</router-link>
        </div>
        <div class="swiper-outside">
          <div class="project-carousel">
            <div class="swiper-wrapper">
              <div class="swiper-slide" v-for="project in projects" :key="project.id">
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
            <div class="carousel-pagination"></div>
          </div>
          <div class="swiper-nav swiper-next"><i class="fa-regular fa-long-arrow-right"></i></div>
          <div class="swiper-nav swiper-prev"><i class="fa-regular fa-long-arrow-left"></i></div>
        </div>
      </div>
    </section>

    <!-- Content Features / Counters -->
    <section class="content-features bg-dark padding-bottom">
      <div class="bg-half"></div>
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
        <div class="row">
          <div class="col-lg-6">
            <div class="section-heading white mb-40">
              <h3 class="sub-heading is-border border-anim">Trusted Path to Global Shipping!<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
              <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Logistics Redefined<br>For <span class="hl">Tomorrow!</span></h2>
              <p class="text-anim" data-effect="fade-in-bottom" data-ease="power4.out">DB Schenker manages the transportation storage, and distribution of goods across the globe.</p>
            </div>
            <ul class="promo-list white mb-30">
              <li class="wow fade-in-bottom" data-wow-delay="100ms">
                <i class="logis logis-airplane-flying"></i>
                <div class="promo-content">
                  <h3>Real-Time Tracking</h3>
                  <p>Full shipment visibility with live tracking updates.</p>
                </div>
              </li>
              <li class="wow fade-in-bottom" data-wow-delay="300ms">
                <i class="logis logis-worldwide"></i>
                <div class="promo-content">
                  <h3>Global Leaders</h3>
                  <p>Operating across 130+ countries worldwide.</p>
                </div>
              </li>
            </ul>
          </div>
          <div class="col-lg-6 position-relative">
            <div class="feature-tab wow fade-in-bottom" data-wow-delay="200ms">
              <nav class="feature-tab-nav">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button class="nav-link" :class="{ active: activeTab === 'tracking' }" @click="activeTab = 'tracking'" type="button">Real Time Tracking</button>
                  <button class="nav-link" :class="{ active: activeTab === 'global' }" @click="activeTab = 'global'" type="button">Global Operation</button>
                </div>
              </nav>
              <div class="tab-content">
                <div class="tab-pane fade" :class="{ 'active show': activeTab === 'tracking' }">
                  <div class="tab-inner">
                    <div class="feature-tab-content">
                      <h3>Real Time Tracking</h3>
                      <p>Monitor every step of your shipment's journey with our advanced real-time tracking system.</p>
                      <ul class="check-list mb-20">
                        <li><i class="fa-solid fa-check"></i>Efficient management of transportation</li>
                        <li><i class="fa-solid fa-check"></i>Specialized transport for fragile goods</li>
                        <li><i class="fa-solid fa-check"></i>Real-time tracking of all shipments</li>
                      </ul>
                      <a href="/track" class="default-btn">Track Now</a>
                    </div>
                    <div class="tab-thumb"><img src="/assets/img/blog/eshipping.jpg" alt="thumb"></div>
                  </div>
                </div>
                <div class="tab-pane fade" :class="{ 'active show': activeTab === 'global' }">
                  <div class="tab-inner">
                    <div class="feature-tab-content">
                      <h3>Global Operation</h3>
                      <p>Our global network ensures your cargo reaches any destination efficiently and on time.</p>
                      <ul class="check-list mb-20">
                        <li><i class="fa-solid fa-check"></i>130+ countries covered</li>
                        <li><i class="fa-solid fa-check"></i>76,000+ employees worldwide</li>
                        <li><i class="fa-solid fa-check"></i>Proven supply chain solutions</li>
                      </ul>
                      <router-link to="/about" class="default-btn">Discover More</router-link>
                    </div>
                    <div class="tab-thumb"><img src="/assets/img/projects/port-terminal.jpg" alt="thumb"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Process Section -->
    <section class="process-section padding">
      <div class="map-pattern"></div>
      <div class="container">
        <div class="section-heading text-center mb-40">
          <h3 class="sub-heading is-border border-anim">Our Working Process!<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">How We Deliver<br>Your <span class="hl">Parcel!</span></h2>
        </div>
        <div class="row process-wrapper gy-lg-0 gy-4">
          <div class="col-lg-3 col-md-6" v-for="step in processSteps" :key="step.id">
            <div class="process-item wow fade-in-bottom" :data-wow-delay="step.delay">
              <div class="process-icon">
                <i :class="step.icon"></i>
                <span>{{ step.id }}</span>
              </div>
              <div class="process-content">
                <h3>{{ step.title }}</h3>
                <p>{{ step.desc }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
      <div class="container">
        <div class="row cta-wrapper gx-0">
          <div class="col-lg-6">
            <div class="section-heading white">
              <h3 class="sub-heading is-border border-anim">Trusted Global Shipping!<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
              <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Ensure Safe Transportation<br>Fast Delivery <span class="hl">Service!</span></h2>
              <a href="/track" class="default-btn wow fade-in-bottom" data-wow-delay="200ms">Track Your Parcel</a>
            </div>
          </div>
          <div class="cta-men wow fade-in-bottom" data-wow-delay="200ms"></div>
        </div>
        <div class="row promo-item-wrapper gx-0">
          <div class="col-lg-4">
            <div class="promo-item">
              <i class="logis logis-truck-3"></i>
              <div class="promo-content"><h3>Road Freight</h3><p>Reliable road freight across all distances.</p></div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="promo-item">
              <i class="logis logis-cruise"></i>
              <div class="promo-content"><h3>Ocean Freight</h3><p>Full and part container load shipping solutions.</p></div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="promo-item">
              <i class="logis logis-airplane-flying"></i>
              <div class="promo-content"><h3>Air Freight</h3><p>Express air cargo for time-critical shipments.</p></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Team Section -->
    <section class="team-section padding">
      <div class="container">
        <div class="section-heading text-center mb-40">
          <h3 class="sub-heading is-border border-anim">Our Logistics Experts<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Delivering Excellence<br>Across Every <span class="hl">Channel!</span></h2>
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

    <!-- Quote / Quick Booking -->
    <section class="quote-section padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="section-heading white mb-40">
              <h3 class="sub-heading is-border border-anim">Trusted Path to Global Shipping!<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
              <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Logistics Redefined<br>For <span class="hl">Tomorrow!</span></h2>
              <p class="text-anim" data-effect="fade-in-bottom" data-ease="power4.out">DB Schenker manages transportation storage, and distribution of goods worldwide.</p>
            </div>
            <div class="call-info white wow fade-in-bottom" data-wow-delay="100ms">
              <i class="fa-light fa-phone"></i>
              <h3>Have Any Questions? <span><a v-if="settings.phone" :href="`tel:${settings.phone}`" style="color:inherit;text-decoration:none;">{{ settings.phone }}</a></span></h3>
            </div>
          </div>
          <div class="col-lg-6 position-relative">
            <div class="quote-form wow fade-in-bottom" data-wow-delay="100ms">
              <form @submit.prevent="submitQuote" class="form-horizontal">
                <div class="form-heading mb-30"><h2>Quick Booking</h2></div>
                <div class="quote-form-group">
                  <div class="form-field"><input type="text" v-model="quote.name" class="form-control" placeholder="Name" required></div>
                  <div class="form-field"><input type="tel" v-model="quote.phone" class="form-control" placeholder="Phone" required></div>
                  <div class="form-field"><input type="text" v-model="quote.departure" class="form-control" placeholder="Departure" required></div>
                  <div class="form-field"><input type="text" v-model="quote.destination" class="form-control" placeholder="Destination" required></div>
                  <div class="form-field"><input type="text" v-model="quote.weight" class="form-control" placeholder="Weight, Kg" required></div>
                  <div class="form-field">
                    <select v-model="quote.freightType" class="form-control">
                      <option value="">Freight Type</option>
                      <option>Road Freight</option>
                      <option>Ocean Freight</option>
                      <option>Air Freight</option>
                    </select>
                  </div>
                  <div class="form-field"><input type="email" v-model="quote.email" class="form-control" placeholder="Email" required></div>
                  <div class="form-field message"><textarea v-model="quote.message" rows="4" class="form-control" placeholder="Additional Details"></textarea></div>
                  <div class="form-field submit-btn"><button class="default-btn" type="submit">Get Solution</button></div>
                </div>
                <div v-if="quoteMsg" class="alert mt-2" role="alert">{{ quoteMsg }}</div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonial-section padding">
      <div class="cargo-container wow fade-in-top" data-wow-delay="100ms"></div>
      <div class="map-pattern"></div>
      <div class="container">
        <div class="section-heading text-center mb-30">
          <h3 class="sub-heading is-border border-anim">Clients Testimonials!<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Customer <span class="hl">Reviews!</span></h2>
        </div>
        <div class="swiper-outside testi-nav position-relative">
          <div class="testimonial-carousel">
            <div class="swiper-wrapper">
              <div class="swiper-slide" v-for="testi in testimonials" :key="testi.id">
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
            <div class="carousel-pagination"></div>
          </div>
          <div class="swiper-nav swiper-next"><i class="fa-regular fa-long-arrow-right"></i></div>
          <div class="swiper-nav swiper-prev"><i class="fa-regular fa-long-arrow-left"></i></div>
        </div>
      </div>
    </section>

    <!-- Sponsors -->
    <div class="sponsor-section">
      <div class="container">
        <div class="sponsor-carousel-wrapper">
          <div class="sponsor-carousel">
            <div class="swiper-wrapper">
              <div class="swiper-slide" v-for="n in 6" :key="n">
                <a href="#"><img :src="`/assets/img/sponsor-0${n}.png`" alt="sponsor"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Blog Section -->
    <section class="blog-section padding">
      <div class="container">
        <div class="section-heading-wrap mb-40">
          <div class="section-heading">
            <h3 class="sub-heading is-border border-anim">News and Insights!<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
            <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Find All Our Logistics<br>Insights <span class="hl">Here!</span></h2>
          </div>
          <router-link to="/blog" class="default-btn wow fade-in-right" data-wow-delay="100ms">View All Insights</router-link>
        </div>
        <div class="row gy-lg-0 gy-4">
          <div class="col-lg-4 col-md-6" v-for="post in blogPosts" :key="post.id">
            <div class="post-card wow fade-in-bottom" :data-wow-delay="post.delay">
              <div class="post-thumb"><img :src="post.img" alt="post"></div>
              <div class="post-content-wrap">
                <router-link to="/blog" class="post-date"><time><span>{{ post.day }}</span>{{ post.month }} {{ post.year }}</time></router-link>
                <ul class="post-meta">
                  <li><i class="fa-regular fa-user"></i><a href="#">{{ post.author }}</a></li>
                  <li><i class="fa-sharp fa-regular fa-bookmark"></i><a href="#">{{ post.category }}</a></li>
                </ul>
                <div class="post-content">
                  <h3><router-link to="/blog/details">{{ post.title }}</router-link></h3>
                  <p>{{ post.excerpt }}</p>
                  <router-link to="/blog/details" class="read-more">Read More</router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue'
import PublicLayout from '../../layouts/PublicLayout.vue'
import { useTemplateInit } from '../../composables/useTemplateInit.js'
import { useSettingsStore } from '../../stores/useSettingsStore.js'
import { homeTestimonials } from '../../data/testimonials.js'
import { useLiveStats } from '../../composables/useLiveStats.js'

useTemplateInit()
const settings = useSettingsStore()
const { stats, deliveryCount, fmtDeliveries } = useLiveStats()

// ── Hero video background ──────────────────────────────────────────────
const videoFailed = ref(false)
const videoReady  = ref(false)

function onVideoError() {
  videoFailed.value = true
  videoReady.value  = false
}

onMounted(async () => {
  // Wait for Swiper to finish cloning slides before querying the video element
  await nextTick()
  const video = document.querySelector('.slider-hero-video')
  if (!video) return

  if (!video.canPlayType || !video.canPlayType('video/webm')) {
    videoFailed.value = true
    return
  }

  video.src = '/assets/video/hero-bg.webm'
  video.load()
  video.play().catch(() => { videoFailed.value = true })
})

const activeTab = ref('tracking')
const quoteMsg = ref('')
const quote = ref({ name: '', phone: '', departure: '', destination: '', weight: '', freightType: '', email: '', message: '' })

const slides = [
  { id: 1, title: 'Highest Standards Of <br><span>Transportation!</span>' },
  { id: 2, title: 'Flexible Global Quick <br>Logistic <span>Solution!</span>' },
  { id: 3, title: 'Global Logistic And <br>Transport <span>Agency!</span>' },
]

const services = [
  {
    id: 1,
    title: 'Transport',
    icon: 'logis logis-truck-2',
    img: '/assets/img/services/transport.jpg',
    link: '/services/transport',
    desc: 'End-to-end road, rail, air and ocean transport tailored to your cargo — domestic or cross-border.',
  },
  {
    id: 2,
    title: 'Contract Logistics',
    icon: 'logis logis-loader',
    img: '/assets/img/services/contract-logistics.jpg',
    link: '/services/logistics',
    desc: 'Integrated warehousing, inventory management and distribution designed around your supply chain.',
  },
  {
    id: 3,
    title: 'Supply Chain Solutions',
    icon: 'logis logis-worldwide',
    img: '/assets/img/services/supply-chain.jpg',
    link: '/services/logistics',
    desc: 'Advanced 4PL consulting for full visibility, flexibility and control across every supply chain tier.',
  },
  {
    id: 4,
    title: 'Air Freight',
    icon: 'logis logis-airplane-flying',
    img: '/assets/img/services/careers.jpg',
    link: '/services/transport',
    desc: 'Express global air cargo for time-critical shipments — with direct handling at major hub airports.',
  },
  {
    id: 5,
    title: 'Ocean Freight',
    icon: 'logis logis-cruise',
    img: '/assets/img/services/insights.jpg',
    link: '/services/logistics',
    desc: 'FCL and LCL ocean freight solutions connecting major global ports with reliable sailing schedules.',
  },
  {
    id: 6,
    title: 'Customs Brokerage',
    icon: 'logis logis-map-1',
    img: '/assets/img/projects/port-terminal.jpg',
    link: '/services/details',
    desc: 'Expert customs clearance, duty optimisation and full compliance management at every border.',
  },
]

const projects = [
  { id: 1, title: 'Port Terminal Container Management', category: 'Ocean Freight', img: '/assets/img/projects/port-terminal.jpg', delay: '200ms' },
  { id: 2, title: 'Cross-Country Fleet Operations', category: 'Road Freight', img: '/assets/img/projects/fleet-operations.jpg', delay: '400ms' },
  { id: 3, title: 'Multi-Modal Ocean Freight Hub', category: 'Ocean Freight', img: '/assets/img/projects/ocean-freight.jpg', delay: '600ms' },
  { id: 4, title: 'Last-Mile Road Freight Delivery', category: 'Road Freight', img: '/assets/img/projects/road-freight.jpg', delay: '700ms' },
  { id: 5, title: 'Global Container Logistics Network', category: 'Logistics', img: '/assets/img/projects/container-logistics.jpg', delay: '800ms' },
]


const processSteps = [
  { id: 1, icon: 'logis logis-package', title: 'Parcel Register', desc: 'Register your shipment with full details and pickup address.', delay: '100ms' },
  { id: 2, icon: 'logis logis-package-1', title: 'Packaging', desc: 'Professional packaging to protect your goods in transit.', delay: '300ms' },
  { id: 3, icon: 'logis logis-truck-2', title: 'Parcel In-Transit', desc: 'Your parcel is picked up and transported along the route.', delay: '500ms' },
  { id: 4, icon: 'logis logis-loader', title: 'Deliver Parcel', desc: 'Final mile delivery to the destination address on time.', delay: '700ms' },
]

const team = [
  { id: 1, name: 'Land Transport', role: 'Freight Experts', img: '/assets/img/team/land-transport.jpg', delay: '100ms' },
  { id: 2, name: 'Air Freight', role: 'Aviation Specialists', img: '/assets/img/team/air-freight.jpg', delay: '300ms' },
  { id: 3, name: 'Ocean Freight', role: 'Maritime Experts', img: '/assets/img/team/ocean-freight.jpg', delay: '500ms' },
  { id: 4, name: 'Contract Logistics', role: 'Supply Chain Team', img: '/assets/img/team/contract-logistics.jpg', delay: '700ms' },
]

const testimonials = homeTestimonials

const blogPosts = [
  { id: 1, title: 'Lost in the Vocabulary of Logistics? We\'ve got you covered!', img: '/assets/img/blog/logistics-terminology.jpg', day: '10', month: 'Jun', year: '2025', author: 'DB Schenker', category: 'Blog', excerpt: 'Confused by logistics jargon? We break down the key terms and concepts you need to navigate the world of freight and supply chains with confidence.', delay: '100ms' },
  { id: 2, title: 'e-Shipping and Tracking: Digital Transparency Across the Supply Chain', img: '/assets/img/blog/eshipping.jpg', day: '27', month: 'May', year: '2025', author: 'DB Schenker', category: 'Automation', excerpt: 'Explore how digital shipping tools and real-time tracking are revolutionizing transparency and efficiency across global supply chains.', delay: '300ms' },
  { id: 3, title: 'The Magic Mix for Freight: Why the Best Shipping Solution Isn\'t Always Black and White', img: '/assets/img/blog/magic-mix-freight.jpg', day: '05', month: 'May', year: '2025', author: 'DB Schenker', category: 'Blog', excerpt: 'From air to ocean to road — the ideal freight solution is rarely a single mode. Discover how a smart mix of transport options delivers the best results.', delay: '500ms' },
]

function submitQuote() {
  quoteMsg.value = 'Your request has been received. We will contact you shortly.'
  quote.value = { name: '', phone: '', departure: '', destination: '', weight: '', freightType: '', email: '', message: '' }
}
</script>

<style scoped>
/* ── Hero video background (lives inside .slider-img) ── */
.slider-hero-video,
.slider-hero-fallback {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
}

/* Fallback: always visible by default, fades out once video is playing */
.slider-hero-fallback {
  z-index: 1;
  opacity: 1;
  transition: opacity 0.8s ease;
}
.slider-hero-fallback--hidden { opacity: 0; }

/* Video: invisible until confirmed playing, then fades in */
.slider-hero-video {
  z-index: 2;
  opacity: 0;
  transition: opacity 0.8s ease;
}
.slider-hero-video--visible { opacity: 1; }
.slider-hero-video--failed  { display: none; }

/* ── Live counter ─────────────────────────────────────── */
.live-stat-wrap { display: inline-flex; align-items: baseline; gap: 2px; }
.live-stat { font-size: inherit; font-weight: inherit; color: inherit; font-family: inherit; }
.stat-suffix { font-size: 0.75em; font-weight: 700; opacity: 0.85; }

/* ── Service carousel image frame ────────────────────── */
.service-section .swiper-outside {
  position: relative;
  max-width: 100%;
}

.service-carousel {
  overflow: hidden;
  max-width: 100%;
}

.service-carousel .swiper-wrapper {
  min-width: 0;
}

.service-carousel .swiper-slide {
  height: auto;
  min-width: 0;
}

.service-thumb-frame {
  width: 100%;
  height: 220px;
  overflow: hidden;
  border-radius: 8px 8px 0 0;
  display: block;
}
.service-thumb-frame img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  display: block;
  transition: transform 0.4s ease;
}
.service-item:hover .service-thumb-frame img {
  transform: scale(1.06);
}
</style>
