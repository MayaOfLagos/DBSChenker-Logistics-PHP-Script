<template>
  <PublicLayout>
    <section class="page-header">
      <div class="container">
        <div class="page-header-info">
          <h4>Help Centre</h4>
          <h2>Frequently Asked<br><span>Questions</span></h2>
          <p>Find answers to the most common questions about DB Schenker's logistics services, tracking, pricing and customs.</p>
        </div>
      </div>
    </section>

    <section class="blog-section padding">
      <div class="container">
        <div class="row">

          <!-- ── Main FAQ ──────────────────────────────────────────────────── -->
          <div class="col-lg-8 sm-padding">

            <!-- Category filter -->
            <div class="faq-cats mb-30">
              <button
                v-for="cat in categories"
                :key="cat"
                class="faq-cat-btn"
                :class="{ active: activeCategory === cat }"
                @click="activeCategory = cat"
              >{{ cat }}</button>
            </div>

            <div class="accordion faq-accordion row-gap" id="faq-accordion">
              <div
                class="accordion-item"
                v-for="faq in filteredFaqs"
                :key="faq.id"
              >
                <h2 class="accordion-header">
                  <button
                    class="accordion-button"
                    :class="{ collapsed: openFaq !== faq.id }"
                    type="button"
                    @click="toggleFaq(faq.id)"
                  >{{ faq.question }}</button>
                </h2>
                <div class="accordion-collapse collapse" :class="{ show: openFaq === faq.id }">
                  <div class="accordion-body"><p>{{ faq.answer }}</p></div>
                </div>
              </div>
            </div>

            <!-- CTA -->
            <div class="faq-cta-block mt-40">
              <div class="faq-cta-inner">
                <i class="logis logis-worldwide faq-cta-icon"></i>
                <div>
                  <h3>Still have questions?</h3>
                  <p>Our logistics experts are available to help. Contact us and we'll get back to you within one business day.</p>
                </div>
                <router-link to="/contact" class="default-btn">Contact Us</router-link>
              </div>
            </div>
          </div>

          <!-- ── Sidebar ───────────────────────────────────────────────────── -->
          <div class="col-lg-4 sm-padding">
            <div class="sidebar-widget search-widget">
              <form @submit.prevent class="search-form">
                <input type="text" v-model="search" class="form-control" placeholder="Search FAQs…">
                <button class="search-btn" type="button"><i class="fa-regular fa-magnifying-glass"></i></button>
              </form>
            </div>

            <div class="sidebar-widget">
              <div class="widget-title"><h3>Quick Links</h3></div>
              <ul class="category-list">
                <li><a href="/track">Track Your Shipment</a><span><i class="fa-regular fa-arrow-right"></i></span></li>
                <li><router-link to="/business/ocean-freight">Ocean Freight</router-link><span><i class="fa-regular fa-arrow-right"></i></span></li>
                <li><router-link to="/business/air-freight">Air Freight</router-link><span><i class="fa-regular fa-arrow-right"></i></span></li>
                <li><router-link to="/business/land-transport">Land Transport</router-link><span><i class="fa-regular fa-arrow-right"></i></span></li>
                <li><router-link to="/business/cargo-insurance">Cargo Insurance</router-link><span><i class="fa-regular fa-arrow-right"></i></span></li>
              </ul>
            </div>

            <div class="sidebar-widget">
              <div class="widget-title"><h3>Recent Articles</h3></div>
              <ul class="thumb-post">
                <li v-for="post in recentPosts" :key="post.id">
                  <div class="thumb"><img :src="post.img" alt="thumb"></div>
                  <div class="thumb-post-info">
                    <h3><router-link to="/blog/details">{{ post.title }}</router-link></h3>
                    <a href="#" class="date">{{ post.date }}</a>
                  </div>
                </li>
              </ul>
            </div>

            <div class="sidebar-widget sidebar-banner">
              <router-link to="/contact"><img src="/assets/img/db-schenker-insights-corporate-sustainability-stage.webp" alt="banner"></router-link>
            </div>

            <div class="sidebar-widget">
              <div class="widget-title"><h3>Tags</h3></div>
              <ul class="tags">
                <li v-for="tag in tags" :key="tag"><a href="#">{{ tag }}</a></li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import { ref, computed } from 'vue'
import PublicLayout from '../../layouts/PublicLayout.vue'
import { useTemplateInit } from '../../composables/useTemplateInit.js'

useTemplateInit()

const search = ref('')
const openFaq = ref(1)
const activeCategory = ref('All')

const categories = ['All', 'Tracking', 'Shipping', 'Customs', 'Pricing', 'Services']

function toggleFaq(id) {
  openFaq.value = openFaq.value === id ? null : id
}

const faqs = [
  // Tracking
  { id: 1, cat: 'Tracking', question: 'How do I track my DB Schenker shipment?', answer: 'You can track any shipment 24/7 through our online Track portal. Enter your reference number (AWB for air, B/L for ocean, waybill for road) on our Track page for live status updates at every milestone. Email notifications can also be set up through your account manager.' },
  { id: 2, cat: 'Tracking', question: 'What tracking reference number do I use?', answer: 'For air freight, use the Air Waybill (AWB) number. For ocean freight, use the Bill of Lading (B/L) or booking reference. For road freight, use the waybill or consignment number. All these are found on your shipping documents or confirmation email.' },
  { id: 3, cat: 'Tracking', question: 'Why is my shipment not showing any updates?', answer: 'Tracking updates may be delayed during transit legs, particularly during ocean voyage or long-haul road transport where intermediate scan points are fewer. If your shipment shows no update for more than 48 hours during expected active transit, please contact our customer service team with your reference number.' },

  // Shipping
  { id: 4, cat: 'Shipping', question: 'What freight modes does DB Schenker offer?', answer: 'DB Schenker provides a full range of freight services: Land Transport (FTL, LTL, rail), Air Freight (express, standard, charter), Ocean Freight (FCL, LCL, reefer), Intermodal (combined modes), and Project Logistics for oversized or complex cargo. All modes are available for import and export.' },
  { id: 5, cat: 'Shipping', question: 'What is the difference between FTL and LTL?', answer: 'FTL (Full Truckload) means your cargo occupies a dedicated truck. It is faster, more cost-effective for large volumes, and cargo is not handled at intermediate depots. LTL (Less Than Truckload) groups your shipment with other consignments in a shared trailer — ideal for smaller volumes but involves sorting at hub depots and slightly longer transit.' },
  { id: 6, cat: 'Shipping', question: 'What is chargeable weight and how is it calculated?', answer: 'Chargeable weight is the greater of actual (gross) weight and volumetric (dimensional) weight. For air freight, volumetric weight = (L × W × H in cm) ÷ 6,000. For ocean LCL, it is the greater of actual weight in tonnes or volume in CBM. You are charged whichever is higher — this ensures that light but bulky cargo is fairly priced.' },
  { id: 7, cat: 'Shipping', question: 'Do you handle dangerous goods (DG / hazardous cargo)?', answer: 'Yes. DB Schenker is certified to handle IATA dangerous goods by air and IMDG dangerous goods by sea. Handling DG cargo requires specific documentation (SDS, declarations), appropriate packaging, and advance notification. Please contact our team before booking any DG shipment so we can advise on classification, documentation, and any mode restrictions.' },
  { id: 8, cat: 'Shipping', question: 'Can you handle temperature-controlled shipments?', answer: 'Yes. We offer temperature-controlled solutions across road (refrigerated trucks), air (cool-chain protocols), and ocean (reefer containers). Our pharma logistics team specialises in GDP-compliant cold chain management for pharmaceuticals, biologics, and temperature-sensitive food products.' },

  // Customs
  { id: 9, cat: 'Customs', question: 'Does DB Schenker handle customs clearance?', answer: 'Yes. DB Schenker provides full customs brokerage services for both import and export in Israel and across all our global markets. Our certified customs brokers handle tariff classification, duty calculation, document submission, and liaise directly with customs authorities — removing the administrative burden from our customers.' },
  { id: 10, cat: 'Customs', question: 'What documents are needed for customs clearance?', answer: 'Standard documents include: Commercial Invoice, Packing List, Bill of Lading or Air Waybill, Certificate of Origin (if required), and Import/Export Licences for regulated goods. Additional documents such as phytosanitary certificates, health certificates, or permits may be required depending on the commodity. Our team will advise on the specific requirements for your shipment.' },
  { id: 11, cat: 'Customs', question: 'What is HS code and why does it matter?', answer: 'An HS (Harmonised System) code is an internationally standardised numerical system for classifying traded goods. It determines the applicable customs duty rate, VAT treatment, and whether any import/export restrictions apply. Incorrect HS classification can result in fines, shipment delays, or cargo seizure. DB Schenker can assist with correct tariff classification.' },

  // Pricing
  { id: 12, cat: 'Pricing', question: 'How is freight pricing calculated?', answer: 'Freight pricing depends on mode, origin, destination, chargeable weight or volume, service level, and applicable surcharges. Base rates are quoted per shipment and typically include origin charges, linehaul, and destination charges. Surcharges (fuel, security, BAF, peak season) are added on top and vary monthly. Contact us for a tailored quote.' },
  { id: 13, cat: 'Pricing', question: 'What surcharges should I expect?', answer: 'Common surcharges include: Fuel Surcharge (FSC) — indexed to fuel prices and revised monthly; Security Surcharge (air); Bunker Adjustment Factor/BAF (ocean); Terminal Handling Charges (THC) at origin/destination ports; Peak Season Surcharge (PSS) during high-demand periods; and Customs Clearance fees. All surcharges are itemised in your quotation.' },
  { id: 14, cat: 'Pricing', question: 'Do you offer contracted rates for regular shippers?', answer: 'Yes. Businesses with regular freight volumes can benefit from contracted rates through a commercial agreement with DB Schenker. Contracted customers receive dedicated account management, priority capacity allocation, fixed rates for agreed periods, and consolidated billing. Contact our sales team to discuss a contract arrangement.' },

  // Services
  { id: 15, cat: 'Services', question: 'What is DB Schenker\'s sustainability commitment?', answer: 'DB Schenker is committed to carbon-neutral logistics by 2040. We offer verified carbon-neutral shipping options across all modes through our ecovative programme — using Sustainable Aviation Fuel (SAF) for air, shore power and slow steaming for ocean, and electric or HVO-fuelled trucks for road. CO₂ reporting is available for all shipments.' },
  { id: 16, cat: 'Services', question: 'Do you offer cargo insurance?', answer: 'Yes. DB Schenker Cargo Insurance provides all-risk coverage for your goods during transit by any mode. Policies can be arranged per shipment or annually for regular shippers. Coverage includes physical loss or damage, total loss, and third-party liability. Speak to our team about the right policy for your cargo type and value.' },
  { id: 17, cat: 'Services', question: 'Can I use DB Schenker for e-commerce fulfilment?', answer: 'Yes. DB Schenker offers comprehensive e-commerce logistics solutions including cross-border freight, customs clearance, domestic last-mile delivery, returns management, and warehousing. Our digital booking platforms integrate with major e-commerce systems for seamless order fulfilment.' },
]

const filteredFaqs = computed(() => {
  let list = activeCategory.value === 'All' ? faqs : faqs.filter(f => f.cat === activeCategory.value)
  if (search.value.trim()) {
    const q = search.value.toLowerCase()
    list = list.filter(f => f.question.toLowerCase().includes(q) || f.answer.toLowerCase().includes(q))
  }
  return list
})

const recentPosts = [
  { id: 1, title: 'Lost in the Vocabulary of Logistics? We\'ve got you covered!', img: '/assets/img/blog/logistics-terminology.jpg', date: 'Jun 10 2025' },
  { id: 2, title: 'e-Shipping: Digital Transparency Across the Supply Chain', img: '/assets/img/blog/eshipping.jpg', date: 'May 27 2025' },
  { id: 3, title: 'The Magic Mix for Freight', img: '/assets/img/blog/magic-mix-freight.jpg', date: 'May 5 2025' },
  { id: 4, title: 'Port Operations: Managing Container Terminals at Scale', img: '/assets/img/projects/port-terminal.jpg', date: 'Apr 15 2025' },
]

const tags = ['tracking', 'customs', 'air freight', 'ocean freight', 'LTL', 'FTL', 'surcharges', 'dangerous goods', 'reefer', 'sustainability']
</script>

<style scoped>
/* Force accordion body text to be visible — Tailwind Preflight can reset color vars */
.accordion-body {
  background-color: #ffffff !important;
}
.accordion-body p {
  color: #333333 !important;
  font-size: 17px;
  line-height: 1.65;
  margin-bottom: 0;
}

.faq-cats { display: flex; flex-wrap: wrap; gap: 8px; }
.faq-cat-btn {
  padding: 7px 18px;
  border: 2px solid #e2e2e2;
  background: #fff;
  border-radius: 20px;
  font-size: .85rem;
  font-weight: 600;
  color: #555;
  cursor: pointer;
  transition: all .2s;
}
.faq-cat-btn:hover,
.faq-cat-btn.active {
  background: #e31e24;
  border-color: #e31e24;
  color: #fff;
}

.faq-cta-block {
  border-radius: 10px;
  background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
  padding: 30px;
  color: #fff;
}
.faq-cta-inner {
  display: flex;
  align-items: center;
  gap: 20px;
  flex-wrap: wrap;
}
.faq-cta-icon { font-size: 2.5rem; color: #e31e24; flex-shrink: 0; }
.faq-cta-inner > div { flex: 1; min-width: 180px; }
.faq-cta-inner h3 { margin: 0 0 4px; font-size: 1.1rem; }
.faq-cta-inner p  { margin: 0; font-size: .88rem; opacity: .8; }
</style>
