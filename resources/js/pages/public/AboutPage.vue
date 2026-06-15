<template>
  <PublicLayout>

    <!-- ── Page Header ─────────────────────────────────────────────────────── -->
    <section class="page-header">
      <div class="container">
        <div class="page-header-info">
          <h4>Our Story</h4>
          <h2>Accelerating Logistics<br><span>Since 1872</span></h2>
          <p>From horse-drawn carriages to freighter drones — over 150 years of shaping global logistics.</p>
        </div>
      </div>
    </section>

    <!-- ── About Intro ─────────────────────────────────────────────────────── -->
    <section class="about-section padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <div class="about-img-wrap mt-50">
              <img class="wow fade-in-left" data-wow-delay="100ms" src="/assets/img/about/history-stage.jpg" alt="DB Schenker truck and airplane">
              <img class="wow fade-in-bottom" data-wow-delay="300ms" src="/assets/img/about/history-2022.jpg" alt="DB Schenker 150 years">
              <img src="/assets/img/delivery-man.png" alt="img">
              <div class="about-img-info">Since 1872</div>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="section-heading mb-40">
              <h3 class="sub-heading is-border border-anim">Trusted Global Logistics Partner<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
              <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">One of the World's<br>Leading <span class="hl">Logistics Providers</span></h2>
              <p class="text-anim" data-effect="fade-in-bottom" data-ease="power4.out">In 1872, Gottfried Schenker changed the game of transportation. More than 150 years later, DB Schenker is one of the world's foremost logistics providers — operating in 130+ countries, moving freight by road, rail, sea, and air, and connecting businesses to global markets every day.</p>
            </div>
            <ul class="promo-list mb-30">
              <li class="wow fade-in-bottom" data-wow-delay="100ms">
                <i class="logis logis-worldwide"></i>
                <div class="promo-content">
                  <h3>130+ Countries</h3>
                  <p>A global network spanning every continent, with local expertise in every market.</p>
                </div>
              </li>
              <li class="wow fade-in-bottom" data-wow-delay="300ms">
                <i class="logis logis-loader"></i>
                <div class="promo-content">
                  <h3>72,700+ Employees</h3>
                  <p>A dedicated global team delivering excellence across all transport modes.</p>
                </div>
              </li>
            </ul>
            <ul class="check-list mb-20 wow fade-in-bottom" data-wow-delay="100ms">
              <li><i class="fa-solid fa-check"></i>Founded in Vienna, Austria in 1872 by Gottfried Schenker</li>
              <li><i class="fa-solid fa-check"></i>Part of Deutsche Bahn Group since 2002</li>
              <li><i class="fa-solid fa-check"></i>€19.2 billion in revenue — a top-5 global logistics group</li>
              <li><i class="fa-solid fa-check"></i>Carbon-neutral operations target by 2040</li>
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

    <!-- ── Key Stats ───────────────────────────────────────────────────────── -->
    <section class="fact-section bg-grey padding">
      <div class="container">
        <div class="section-heading text-center mb-40">
          <h3 class="sub-heading is-border border-anim">DB Schenker by the Numbers<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">150+ Years of<br>Logistics <span class="hl">Excellence</span></h2>
        </div>
        <div class="row gy-4 text-center">
          <div class="col-lg-3 col-md-6" v-for="stat in stats" :key="stat.label">
            <div class="fact-item wow fade-in-bottom" :data-wow-delay="stat.delay">
              <div class="fact-icon"><i :class="stat.icon"></i></div>
              <h2 class="fact-count">{{ stat.value }}</h2>
              <h4>{{ stat.label }}</h4>
              <p>{{ stat.desc }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ── History Timeline ────────────────────────────────────────────────── -->
    <section class="padding">
      <div class="container">
        <div class="section-heading text-center mb-40">
          <h3 class="sub-heading is-border border-anim">Our Heritage<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Once Upon a Time<br>in <span class="hl">Logistics</span></h2>
          <p>From horse-drawn carriages to freighter drones — we have a lot of experience and many stories to tell.</p>
        </div>
        <div class="timeline-wrap">
          <div class="timeline-item wow fade-in-bottom" v-for="(item, i) in timeline" :key="item.year" :data-wow-delay="`${i * 100}ms`">
            <div class="timeline-year"><span>{{ item.year }}</span></div>
            <div class="timeline-content">
              <h4>{{ item.title }}</h4>
              <p>{{ item.desc }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ── Recent Years Milestones ─────────────────────────────────────────── -->
    <section class="service-section bg-grey padding">
      <div class="map-pattern"></div>
      <div class="container">
        <div class="section-heading text-center mb-40">
          <h3 class="sub-heading is-border border-anim">Recent Milestones<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Feels Like Yesterday:<br>Our <span class="hl">Recent Years</span></h2>
          <p>As logistics people, we're used to a fast pace and accelerate our services each year.</p>
        </div>
        <!-- Tab buttons -->
        <div class="milestone-tabs mb-30">
          <button
            v-for="tab in milestones"
            :key="tab.year"
            class="milestone-tab-btn"
            :class="{ active: activeTab === tab.year }"
            @click="activeTab = tab.year"
          >{{ tab.year }}</button>
        </div>
        <!-- Tab panels -->
        <div v-for="tab in milestones" :key="`panel-${tab.year}`" v-show="activeTab === tab.year">
          <div class="row align-items-center gy-4">
            <div class="col-lg-5">
              <div class="post-thumb wow fade-in-left" data-wow-delay="100ms">
                <img :src="tab.img" :alt="tab.title" style="width:100%;border-radius:8px;object-fit:cover;">
              </div>
            </div>
            <div class="col-lg-7">
              <div class="section-heading mb-20">
                <h3>{{ tab.title }}</h3>
              </div>
              <ul class="check-list mb-20">
                <li v-for="point in tab.points" :key="point">
                  <i class="fa-solid fa-check"></i>{{ point }}
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ── Historic Photo Gallery ──────────────────────────────────────────── -->
    <section class="padding">
      <div class="container">
        <div class="section-heading text-center mb-40">
          <h3 class="sub-heading is-border border-anim">Our Archive<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">150 Years of<br><span class="hl">History in Pictures</span></h2>
        </div>
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6" v-for="(photo, i) in gallery" :key="photo.src">
            <div class="project-item wow fade-in-bottom" :data-wow-delay="`${i * 150}ms`">
              <div class="project-thumb">
                <img :src="photo.src" :alt="photo.alt" style="width:100%;height:260px;object-fit:cover;border-radius:8px;">
              </div>
              <div class="project-content">
                <h4>{{ photo.caption }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ── Services ────────────────────────────────────────────────────────── -->
    <section class="service-section bg-grey padding">
      <div class="map-pattern"></div>
      <div class="container">
        <div class="section-heading text-center mb-40">
          <h3 class="sub-heading is-border border-anim">What We Do<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Integrated Logistics<br>for Every <span class="hl">Industry</span></h2>
        </div>
        <div class="row gy-lg-0 gy-4">
          <div class="col-lg-4 col-md-6">
            <div class="service-item wow fade-in-bottom" data-wow-delay="100ms">
              <div class="service-thumb"><img src="/assets/img/services/transport.jpg" alt="Road Freight"></div>
              <div class="service-content">
                <div class="service-icon"><i class="logis logis-truck-2"></i></div>
                <h3><router-link to="/business/land-transport">Land Transport</router-link></h3>
                <p>Cross-border and domestic road freight solutions for all cargo sizes and types across Israel and the region.</p>
                <router-link class="read-more" to="/business/land-transport">Read More</router-link>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="service-item wow fade-in-bottom" data-wow-delay="300ms">
              <div class="service-thumb"><img src="/assets/img/projects/ocean-freight.jpg" alt="Ocean Freight"></div>
              <div class="service-content">
                <div class="service-icon"><i class="logis logis-cruise"></i></div>
                <h3><router-link to="/business/ocean-freight">Ocean Freight</router-link></h3>
                <p>FCL and LCL ocean freight with AI-powered tracking connecting major ports globally.</p>
                <router-link class="read-more" to="/business/ocean-freight">Read More</router-link>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="service-item wow fade-in-bottom" data-wow-delay="500ms">
              <div class="service-thumb"><img src="/assets/img/team/air-freight.jpg" alt="Air Freight"></div>
              <div class="service-content">
                <div class="service-icon"><i class="logis logis-airplane-flying"></i></div>
                <h3><router-link to="/business/air-freight">Air Freight</router-link></h3>
                <p>Express air cargo solutions for time-sensitive and high-value shipments to 550+ destinations.</p>
                <router-link class="read-more" to="/business/air-freight">Read More</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ── Running Text ─────────────────────────────────────────────────────── -->
    <section class="running-text">
      <div class="container">
        <div class="scroller" data-speed="slow">
          <ul class="text-anim scroller__inner">
            <li>Global logistics experts</li>
            <li>Founded 1872 · Vienna, Austria</li>
            <li>130+ countries worldwide</li>
            <li>Carbon neutral by 2040</li>
            <li>72,700+ employees globally</li>
            <li>Leading global logistics company</li>
          </ul>
        </div>
      </div>
    </section>

    <!-- ── Quick Booking ───────────────────────────────────────────────────── -->
    <section class="quote-section padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="section-heading white mb-40">
              <h3 class="sub-heading is-border border-anim">Trusted Path to Global Shipping!<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
              <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Logistics Redefined<br>For <span class="hl">Tomorrow!</span></h2>
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
                  <div class="form-field"><input type="text" v-model="q.name" class="form-control" placeholder="Name" required></div>
                  <div class="form-field"><input type="tel" v-model="q.phone" class="form-control" placeholder="Phone" required></div>
                  <div class="form-field"><input type="text" v-model="q.departure" class="form-control" placeholder="Departure" required></div>
                  <div class="form-field"><input type="text" v-model="q.destination" class="form-control" placeholder="Destination" required></div>
                  <div class="form-field"><input type="text" v-model="q.weight" class="form-control" placeholder="Weight, Kg" required></div>
                  <div class="form-field">
                    <select v-model="q.type" class="form-control">
                      <option value="">Freight Type</option>
                      <option>Road Freight</option>
                      <option>Ocean Freight</option>
                      <option>Air Freight</option>
                      <option>Intermodal</option>
                    </select>
                  </div>
                  <div class="form-field"><input type="email" v-model="q.email" class="form-control" placeholder="Email" required></div>
                  <div class="form-field message"><textarea v-model="q.message" rows="4" class="form-control" placeholder="Additional Details"></textarea></div>
                  <div class="form-field submit-btn"><button class="default-btn" type="submit">Get Solution</button></div>
                </div>
                <div v-if="msg" class="alert mt-2">{{ msg }}</div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ── CTA ─────────────────────────────────────────────────────────────── -->
    <section class="cta-section padding-bottom">
      <div class="container">
        <div class="row cta-wrapper gx-0">
          <div class="col-lg-6">
            <div class="section-heading white">
              <h3 class="sub-heading is-border border-anim">Trusted Global Shipping!<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
              <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Move Your Cargo<br>With <span class="hl">Confidence!</span></h2>
              <router-link to="/contact" class="default-btn wow fade-in-bottom" data-wow-delay="200ms">Get a Quote</router-link>
            </div>
          </div>
          <div class="cta-men wow fade-in-bottom" data-wow-delay="200ms"></div>
        </div>
        <div class="row promo-item-wrapper gx-0">
          <div class="col-lg-4"><div class="promo-item"><i class="logis logis-truck-3"></i><div class="promo-content"><h3>Land Transport</h3><p>FTL, LTL and express road freight solutions.</p></div></div></div>
          <div class="col-lg-4"><div class="promo-item"><i class="logis logis-cruise"></i><div class="promo-content"><h3>Ocean Freight</h3><p>FCL &amp; LCL with AI-powered vessel tracking.</p></div></div></div>
          <div class="col-lg-4"><div class="promo-item"><i class="logis logis-airplane-flying"></i><div class="promo-content"><h3>Air Freight</h3><p>Express cargo to 550+ destinations worldwide.</p></div></div></div>
        </div>
      </div>
    </section>

  </PublicLayout>
</template>

<script setup>
import { ref } from 'vue'
import PublicLayout from '../../layouts/PublicLayout.vue'
import { useTemplateInit } from '../../composables/useTemplateInit.js'
import { useSettingsStore } from '../../stores/useSettingsStore.js'

useTemplateInit()
const settings = useSettingsStore()

const stats = [
  { value: '150+',    label: 'Years of History',    desc: 'Founded in Vienna, Austria in 1872 by Gottfried Schenker.',   icon: 'logis logis-map-1',           delay: '100ms' },
  { value: '72,700+', label: 'Global Employees',    desc: 'A dedicated team delivering excellence across all transport modes.', icon: 'logis logis-loader',     delay: '200ms' },
  { value: '130+',    label: 'Countries Served',    desc: 'Delivering to every major market on six continents.',          icon: 'logis logis-worldwide',        delay: '300ms' },
  { value: '€19.2B',  label: 'Annual Revenue',      desc: 'One of the world\'s top-5 logistics groups by revenue.',      icon: 'logis logis-truck-2',          delay: '400ms' },
]

const timeline = [
  { year: '1872', title: 'Founded in Vienna',      desc: 'Gottfried Schenker establishes Schenker & Co. in Vienna, Austria, revolutionising European freight forwarding.' },
  { year: '1922', title: 'First Air Freight',       desc: 'Schenker pioneers the first air freight shipments in Germany — laying the foundation for a global air cargo network.' },
  { year: '1947', title: 'US Expansion',            desc: 'A US subsidiary is established, marking the beginning of large-scale international growth and air freight expansion.' },
  { year: '1972', title: 'Olympic Logistics',       desc: 'Schenker becomes the official freight forwarder for the Munich Olympics, establishing a legacy of major event logistics.' },
  { year: '1997', title: 'Three New Business Areas',desc: 'Schenker AG forms three new divisions: Schenker Logistics, Schenker International, and Schenker Eurocargo.' },
  { year: '2002', title: 'Deutsche Bahn Acquisition',desc: 'Deutsche Bahn takes over majority of Stinnes, bringing Schenker under DB Group umbrella.' },
  { year: '2016', title: 'Middle East Hub',         desc: 'DB Schenker opens its first logistics center in the Middle East in Dubai, strengthening regional operations.' },
  { year: '2022', title: '150 Years — Still Accelerating', desc: 'DB Schenker celebrates 150 years with global festivities, new sustainability programs, and expanded digital services.' },
]

const milestones = [
  {
    year: '2022',
    title: 'Celebrating 150 Years!',
    img: '/assets/img/about/history-2022.jpg',
    points: [
      'DB Schenker celebrates "150 Years Elevating Lives" with festivities on all continents.',
      'Launch of global CO₂-neutral air freight using Sustainable Aviation Fuel (SAF).',
      'Opening of renewable-powered mega hub DLC 3 in Dubai.',
      'eTrailers introduced to decarbonize long-haul road freight.',
    ],
  },
  {
    year: '2021',
    title: 'Drones. Yes, you heard right.',
    img: '/assets/img/about/history-2021.jpg',
    points: [
      'Lufthansa Cargo and DB Schenker announce joint commitment on sustainable aviation.',
      'DB Schenker invests in autonomous mobile robotics pioneer Gideon Brothers.',
      'First-ever public flight of the heavy-lift cargo drone VoloDrone.',
    ],
  },
  {
    year: '2020',
    title: 'Into the Future',
    img: '/assets/img/about/history-2020.jpg',
    points: [
      'First commercial carbon-neutral cargo flight in logistics history.',
      'New Singapore warehouse Red Lion marks a record €101 million corporate investment.',
      'Expanded digital supply chain visibility tools launched globally.',
    ],
  },
  {
    year: '2019',
    title: 'Passion-Powered Solutions',
    img: '/assets/img/about/history-2019.jpg',
    points: [
      'DB Schenker is first to run Volvo\'s fully electric-powered distribution truck in daily traffic.',
      'Opening of the first low-carbon distribution terminal in Norway — Oslo City Hub.',
      'Opening of a full solar-powered logistics center in Dubai.',
    ],
  },
]

const gallery = [
  { src: '/assets/img/about/history-gallery-1.jpg', alt: 'Historic DB Schenker card',         caption: 'Historic Schenker memorabilia' },
  { src: '/assets/img/about/history-gallery-2.jpg', alt: 'Early days drawing of DB Schenker', caption: 'Early days of Schenker, 19th century' },
  { src: '/assets/img/about/history-gallery-3.jpg', alt: 'One of the earliest DB Schenker sites', caption: 'Early Schenker operations' },
]

const activeTab = ref('2022')

const msg = ref('')
const q = ref({ name: '', phone: '', departure: '', destination: '', weight: '', type: '', email: '', message: '' })
function submitQuote() {
  msg.value = 'Your request has been received. We will contact you shortly.'
  q.value = { name: '', phone: '', departure: '', destination: '', weight: '', type: '', email: '', message: '' }
}
</script>

<style scoped>
/* ── Key Stats ────────────────────────────────────────────────────────────── */
.fact-item {
  padding: 30px 20px;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 20px rgba(0,0,0,.08);
  transition: transform .25s;
}
.fact-item:hover { transform: translateY(-4px); }
.fact-icon { font-size: 2.2rem; color: #e31e24; margin-bottom: 12px; }
.fact-count { font-size: 2.4rem; font-weight: 800; color: #1a1a2e; line-height: 1; margin-bottom: 6px; }
.fact-item h4 { font-size: 1rem; font-weight: 700; color: #333; margin-bottom: 6px; }
.fact-item p  { font-size: .85rem; color: #666; margin: 0; }

/* ── Timeline ─────────────────────────────────────────────────────────────── */
.timeline-wrap { position: relative; padding-left: 40px; }
.timeline-wrap::before {
  content: '';
  position: absolute;
  left: 16px; top: 0; bottom: 0;
  width: 2px;
  background: linear-gradient(to bottom, #e31e24, #ff6b6b, #e31e24);
}
.timeline-item {
  position: relative;
  margin-bottom: 36px;
  padding-left: 20px;
}
.timeline-item::before {
  content: '';
  position: absolute;
  left: -28px; top: 6px;
  width: 14px; height: 14px;
  border-radius: 50%;
  background: #e31e24;
  border: 3px solid #fff;
  box-shadow: 0 0 0 2px #e31e24;
}
.timeline-year {
  margin-bottom: 6px;
}
.timeline-year span {
  display: inline-block;
  background: #e31e24;
  color: #fff;
  font-weight: 700;
  font-size: .85rem;
  padding: 2px 12px;
  border-radius: 20px;
  letter-spacing: .05em;
}
.timeline-content h4 { font-size: 1.05rem; font-weight: 700; margin-bottom: 4px; color: #1a1a2e; }
.timeline-content p  { font-size: .9rem; color: #555; margin: 0; }

/* ── Milestone Tabs ───────────────────────────────────────────────────────── */
.milestone-tabs { display: flex; gap: 10px; flex-wrap: wrap; }
.milestone-tab-btn {
  padding: 9px 22px;
  background: #f2f2f2;
  border: 2px solid transparent;
  border-radius: 6px;
  font-weight: 700;
  font-size: .9rem;
  color: #333;
  cursor: pointer;
  transition: all .2s;
}
.milestone-tab-btn:hover,
.milestone-tab-btn.active {
  background: #e31e24;
  border-color: #e31e24;
  color: #fff;
}
</style>
