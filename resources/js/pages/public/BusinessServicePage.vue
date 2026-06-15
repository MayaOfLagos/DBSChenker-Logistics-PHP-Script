<template>
  <PublicLayout>
    <section class="page-header">
      <div class="container">
        <div class="page-header-info">
          <h4>Business</h4>
          <h2>{{ service.title }}<br><span>{{ service.subtitle }}</span></h2>
          <p>{{ service.tagline }}</p>
        </div>
      </div>
    </section>

    <section class="blog-section padding">
      <div class="container">
        <div class="row">
          <!-- Main content -->
          <div class="col-lg-8 sm-padding">
            <div class="service-details-wrap row-gap">
              <div class="post-thumb mb-30">
                <img :src="service.img" :alt="service.title">
              </div>
              <h2>{{ service.title }}</h2>
              <p>{{ service.description }}</p>

              <div class="row gy-4 my-3">
                <div class="col-md-6" v-for="feat in service.features" :key="feat.title">
                  <div class="service-item">
                    <div class="service-content">
                      <div class="service-icon"><i :class="feat.icon"></i></div>
                      <h3>{{ feat.title }}</h3>
                      <p>{{ feat.desc }}</p>
                    </div>
                  </div>
                </div>
              </div>

              <ul class="check-list mb-20">
                <li v-for="point in service.bullets" :key="point">
                  <i class="fa-solid fa-check"></i>{{ point }}
                </li>
              </ul>

              <p>{{ service.closing }}</p>

              <router-link to="/contact" class="default-btn mt-20">Get a Quote</router-link>
            </div>
          </div>

          <!-- Sidebar -->
          <div class="col-lg-4 sm-padding">
            <div class="sidebar-widget">
              <div class="widget-title"><h3>Our Business</h3></div>
              <ul class="footer-links">
                <li v-for="item in businessLinks" :key="item.slug">
                  <router-link :to="`/business/${item.slug}`" :class="{ active: item.slug === slug }">
                    {{ item.title }}
                  </router-link>
                </li>
              </ul>
            </div>

            <div class="sidebar-widget mt-30">
              <div class="widget-title"><h3>Need Help?</h3></div>
              <div class="contact-info">
                <p>Our team is ready to assist with your logistics requirements.</p>
                <router-link to="/contact" class="default-btn mt-20" style="width:100%;text-align:center;display:block">Contact Us</router-link>
                <a href="/track" class="default-btn mt-10" style="width:100%;text-align:center;display:block;background:#555">Track Shipment</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import PublicLayout from '../../layouts/PublicLayout.vue'
import { useTemplateInit } from '../../composables/useTemplateInit.js'

useTemplateInit()

const route = useRoute()
const slug  = computed(() => route.params.slug)

const businessLinks = [
  { slug: 'land-transport',     title: 'Land Transport' },
  { slug: 'air-freight',        title: 'Air Freight' },
  { slug: 'ocean-freight',      title: 'Ocean Freight' },
  { slug: 'intermodal',         title: 'Intermodal Solutions' },
  { slug: 'project-logistics',  title: 'Project Logistics' },
  { slug: 'carrier',            title: 'Carrier Business' },
  { slug: 'cargo-insurance',    title: 'Cargo Insurance' },
]

const serviceData = {
  'land-transport': {
    title: 'Land Transport',
    subtitle: 'Road & Rail Freight Solutions',
    tagline: 'Reliable land transport across Israel and the wider Middle East region.',
    img: '/assets/img/services/transport.jpg',
    description: 'DB Schenker\'s land transport division delivers comprehensive road and rail freight solutions tailored to businesses of all sizes. With an extensive network covering Israel, the Levant, and beyond, we ensure your goods move efficiently between origin and destination with full traceability at every step.',
    features: [
      { icon: 'logis logis-truck-2',  title: 'Full Truckload (FTL)',      desc: 'Dedicated truck capacity for large shipments with direct delivery and no intermediate stops.' },
      { icon: 'logis logis-truck-3',  title: 'Less Than Truckload (LTL)', desc: 'Cost-effective groupage solutions sharing trailer space for smaller consignments.' },
      { icon: 'logis logis-loader',   title: 'Express Road Freight',      desc: 'Time-critical road deliveries with guaranteed transit times across the region.' },
      { icon: 'logis logis-package',  title: 'Temperature Controlled',    desc: 'Refrigerated transport for pharmaceuticals, food and sensitive cargo.' },
    ],
    bullets: [
      'Real-time GPS tracking on all vehicles',
      'Experienced, certified drivers',
      'Cross-border customs handling included',
      'Flexible pickup and delivery windows',
      '24/7 customer support and live updates',
    ],
    closing: 'Our land transport network connects all major economic centers across Israel and the region, delivering competitive rates and reliable transit times for every cargo type.',
  },

  'air-freight': {
    title: 'Air Freight',
    subtitle: 'Global Air Cargo Solutions',
    tagline: 'Express air cargo to any destination worldwide, fast and secure.',
    img: '/assets/img/team/air-freight.jpg',
    description: 'DB Schenker is one of the world\'s leading air freight providers, operating across 550+ locations globally. Our air freight solutions combine speed, reliability and full supply chain visibility — from charter services to consolidated cargo and next-flight-out options for urgent shipments.',
    features: [
      { icon: 'logis logis-airplane-flying', title: 'Express Air Cargo',     desc: 'Next-flight-out and overnight delivery for time-critical consignments.' },
      { icon: 'logis logis-package',         title: 'Charter Services',      desc: 'Full aircraft charters for oversized, high-value or time-sensitive cargo.' },
      { icon: 'logis logis-worldwide',       title: 'Consolidation (LCL)',   desc: 'Consolidated air freight for smaller shipments at competitive rates.' },
      { icon: 'logis logis-loader',          title: 'Sustainable Air (SAF)', desc: 'Carbon-neutral air freight using Sustainable Aviation Fuel, reducing emissions by up to 95%.' },
    ],
    bullets: [
      'Access to 550+ air freight locations worldwide',
      'Partnerships with all major carriers',
      'Real-time flight status and customs tracking',
      'Dangerous goods (DG) certified handling',
      'CO₂-neutral shipping options with SAF',
    ],
    closing: 'From Tel Aviv Ben Gurion Airport to destinations across six continents, DB Schenker\'s air freight team ensures your cargo flies fast, safe, and fully compliant.',
  },

  'ocean-freight': {
    title: 'Ocean Freight',
    subtitle: 'FCL & LCL Global Sea Freight',
    tagline: 'Reliable ocean freight connecting Israel to every major port worldwide.',
    img: '/assets/img/projects/ocean-freight.jpg',
    description: 'DB Schenker manages full container loads (FCL) and less-than-container loads (LCL) across all major trade lanes. Backed by our AI-powered Ocean Bridge platform for real-time vessel tracking and predictive delay alerts, we give you full visibility and control over your sea shipments.',
    features: [
      { icon: 'logis logis-cruise',   title: 'Full Container Load (FCL)', desc: 'Dedicated container capacity for large shipments with direct port-to-port service.' },
      { icon: 'logis logis-package',  title: 'LCL Groupage',             desc: 'Share container space for smaller consignments with weekly departures on all major lanes.' },
      { icon: 'logis logis-worldwide', title: 'Ocean Bridge Visibility',  desc: 'AI-powered tracking with AIS vessel data and predictive arrival alerts.' },
      { icon: 'logis logis-loader',   title: 'Reefer & Special Cargo',   desc: 'Temperature-controlled and out-of-gauge solutions for sensitive or oversized shipments.' },
    ],
    bullets: [
      'Coverage on all major trade lanes globally',
      'Weekly departures from Haifa and Ashdod ports',
      'Real-time Ocean Bridge tracking platform',
      'Port-to-door delivery with customs clearance',
      'Emission-free ocean freight options available',
    ],
    closing: 'Whether you\'re shipping a single pallet or multiple containers, our ocean freight team delivers competitive rates, reliable schedules and complete visibility from port to door.',
  },

  'intermodal': {
    title: 'Intermodal Solutions',
    subtitle: 'Road, Rail, Sea & Air Combined',
    tagline: 'Seamlessly connecting transport modes for smarter, greener logistics.',
    img: '/assets/img/projects/container-logistics.jpg',
    description: 'Intermodal logistics combines the strengths of road, rail, ocean and air transport into a single, optimised supply chain. DB Schenker\'s intermodal solutions reduce cost and carbon footprint by selecting the best mode or combination of modes for each leg of your shipment journey.',
    features: [
      { icon: 'logis logis-truck-2',         title: 'Road + Rail',        desc: 'Combine road pickup with rail linehaul for long-distance domestic and cross-border routes.' },
      { icon: 'logis logis-cruise',          title: 'Sea + Road',         desc: 'Ocean freight with door delivery via local road distribution networks.' },
      { icon: 'logis logis-airplane-flying', title: 'Air + Road',         desc: 'Express air freight combined with last-mile road delivery for end-to-end speed.' },
      { icon: 'logis logis-worldwide',       title: 'Multi-Modal Design', desc: 'Supply chain experts design the optimal route and mode mix for your specific cargo.' },
    ],
    bullets: [
      'Lower carbon emissions vs. all-road transport',
      'Cost savings on long-haul routes',
      'Single point of contact across all modes',
      'Unified tracking across every transport leg',
      'Flexible solutions for standard and special cargo',
    ],
    closing: 'By intelligently combining transport modes, DB Schenker\'s intermodal solutions help you achieve greater efficiency, lower costs, and a reduced environmental footprint.',
  },

  'project-logistics': {
    title: 'Project Logistics',
    subtitle: 'Complex & Oversized Cargo Expertise',
    tagline: 'End-to-end project logistics for the most demanding cargo challenges.',
    img: '/assets/img/projects/port-terminal.jpg',
    description: 'DB Schenker\'s project logistics division specialises in the planning and execution of complex, high-value or oversized shipments that require exceptional coordination. From industrial machinery and energy infrastructure to trade fair exhibits and military equipment, we handle what others cannot.',
    features: [
      { icon: 'logis logis-loader',   title: 'Heavy Lift & OOG',    desc: 'Oversized and out-of-gauge cargo handling with specialised equipment and route surveys.' },
      { icon: 'logis logis-map-1',    title: 'Route Engineering',   desc: 'Detailed transport feasibility studies and permits for complex cargo movements.' },
      { icon: 'logis logis-worldwide', title: 'Energy & Industrial', desc: 'End-to-end logistics for energy sector projects, plant relocations and construction.' },
      { icon: 'logis logis-package',  title: 'Trade Fair Logistics', desc: 'Specialised exhibition logistics including handling, setup and return transport.' },
    ],
    bullets: [
      'Dedicated project management team',
      'Customs and permit coordination worldwide',
      'Specialised heavy-lift and OOG equipment',
      'Full cargo insurance and risk management',
      'On-site supervision available globally',
    ],
    closing: 'When your cargo is too complex, too large or too critical for standard logistics, DB Schenker\'s project logistics team delivers the expertise and execution to get it done.',
  },

  'carrier': {
    title: 'Carrier Business',
    subtitle: 'Subcontracting & Network Partnerships',
    tagline: 'Grow your capacity and reach through DB Schenker\'s carrier network.',
    img: '/assets/img/projects/fleet-operations.jpg',
    description: 'DB Schenker\'s Carrier Business division connects transport companies and subcontractors with a global freight network. By becoming a DB Schenker carrier partner, you gain access to consistent freight volumes, digital load management tools, and a trusted commercial relationship with one of the world\'s leading logistics providers.',
    features: [
      { icon: 'logis logis-truck-2',  title: 'Freight Subcontracting', desc: 'Regular freight assignments matched to your fleet capacity and operating region.' },
      { icon: 'logis logis-loader',   title: 'Digital Load Board',     desc: 'Access available loads through our carrier portal with transparent pricing and terms.' },
      { icon: 'logis logis-map-1',    title: 'Network Integration',    desc: 'Become part of the DB Schenker ground network for domestic and cross-border lanes.' },
      { icon: 'logis logis-package',  title: 'Carrier Development',    desc: 'Training, compliance support and growth opportunities for carrier partners.' },
    ],
    bullets: [
      'Stable, long-term freight volume commitments',
      'Fast payment cycles and transparent rates',
      'Digital booking and proof-of-delivery tools',
      'Full compliance and certification support',
      'Access to DB Schenker\'s global client base',
    ],
    closing: 'Whether you operate a single truck or a large fleet, our Carrier Business programme offers the volume, tools and partnership you need to grow with DB Schenker.',
  },

  'cargo-insurance': {
    title: 'Cargo Insurance',
    subtitle: 'Full Protection for Your Shipments',
    tagline: 'Comprehensive cargo insurance covering land, sea, air and special risks.',
    img: '/assets/img/blog/logistics-terminology.jpg',
    description: 'DB Schenker offers tailored cargo insurance solutions that protect your goods throughout every stage of the supply chain. From standard transit coverage to all-risk policies for high-value or sensitive cargo, our insurance specialists ensure you are fully protected against loss, damage and liability.',
    features: [
      { icon: 'logis logis-package',  title: 'All-Risk Coverage',     desc: 'Comprehensive protection against physical loss or damage during transit by any mode.' },
      { icon: 'logis logis-loader',   title: 'Total Loss Coverage',   desc: 'Protection against total loss events including shipwreck, aircraft loss and vehicle accidents.' },
      { icon: 'logis logis-map-1',    title: 'Special Cargo Policies', desc: 'Tailored policies for high-value goods, pharmaceuticals, art and sensitive cargo.' },
      { icon: 'logis logis-worldwide', title: 'Liability Insurance',  desc: 'Third-party liability coverage for damage caused during loading, transit or delivery.' },
    ],
    bullets: [
      'Coverage for all transport modes: road, sea, air, rail',
      'Competitive premiums with flexible policy terms',
      'Fast, straightforward claims processing',
      'Expert risk assessment and consultancy',
      'Available as standalone or bundled with DB Schenker shipments',
    ],
    closing: 'Protect your supply chain investment with DB Schenker Cargo Insurance — because peace of mind is as important as the shipment itself.',
  },
}

const service = computed(() => serviceData[slug.value] ?? {
  title: 'Business Services',
  subtitle: 'DB Schenker Solutions',
  tagline: 'World-class logistics solutions tailored to your business.',
  img: '/assets/img/services/transport.jpg',
  description: 'DB Schenker provides integrated logistics services across all transport modes.',
  features: [],
  bullets: [],
  closing: 'Contact our team to learn more about how we can support your supply chain.',
})
</script>
