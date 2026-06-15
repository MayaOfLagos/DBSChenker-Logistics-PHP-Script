<template>
  <PublicLayout>
    <section class="page-header">
      <div class="container">
        <div class="page-header-info">
          <h4>Plans &amp; Pricing</h4>
          <h2>Transparent Freight<br><span>Pricing, Explained</span></h2>
          <p>DB Schenker pricing is always quote-based — here's exactly what drives the cost and what each service level includes.</p>
        </div>
      </div>
    </section>

    <!-- ── How Pricing Works ──────────────────────────────────────────────── -->
    <section class="about-section padding">
      <div class="container">
        <div class="section-heading text-center mb-40">
          <h3 class="sub-heading is-border border-anim">How It Works<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Every Freight Quote<br>is <span class="hl">Built Around You</span></h2>
          <p style="max-width:640px;margin:0 auto;">Logistics pricing is never one-size-fits-all. DB Schenker builds each quote based on shipment specifics, route, service level, and live market conditions — ensuring you pay for exactly what you need, nothing more.</p>
        </div>
        <div class="row gy-4">
          <div class="col-lg-3 col-md-6" v-for="step in howItWorks" :key="step.title">
            <div class="service-item text-center wow fade-in-bottom" :data-wow-delay="step.delay">
              <div class="service-content" style="padding:30px 20px;">
                <div class="service-icon"><i :class="step.icon"></i></div>
                <h3>{{ step.title }}</h3>
                <p>{{ step.desc }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ── Pricing by Mode ────────────────────────────────────────────────── -->
    <section class="service-section bg-grey padding">
      <div class="map-pattern"></div>
      <div class="container">
        <div class="section-heading text-center mb-40">
          <h3 class="sub-heading is-border border-anim">Pricing by Transport Mode<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">What Determines the<br>Cost of Your <span class="hl">Shipment?</span></h2>
        </div>

        <!-- Mode tabs -->
        <div class="milestone-tabs mb-30">
          <button
            v-for="mode in modes"
            :key="mode.id"
            class="milestone-tab-btn"
            :class="{ active: activeMode === mode.id }"
            @click="activeMode = mode.id"
          >
            <i :class="mode.icon" style="margin-right:6px;"></i>{{ mode.label }}
          </button>
        </div>

        <div v-for="mode in modes" :key="`mode-${mode.id}`" v-show="activeMode === mode.id">
          <div class="row align-items-start gy-4">
            <div class="col-lg-6">
              <div class="section-heading mb-20">
                <h3>{{ mode.title }}</h3>
                <p>{{ mode.intro }}</p>
              </div>
              <h5 class="pricing-factor-heading">Key Pricing Factors</h5>
              <ul class="check-list mb-20">
                <li v-for="f in mode.factors" :key="f"><i class="fa-solid fa-check"></i>{{ f }}</li>
              </ul>
            </div>
            <div class="col-lg-6">
              <div class="row gy-3">
                <div class="col-md-6" v-for="tier in mode.tiers" :key="tier.name">
                  <div class="pricing-mode-card" :class="{ featured: tier.featured }">
                    <div class="pmc-head">
                      <span class="pmc-badge" v-if="tier.featured">Most Popular</span>
                      <h4>{{ tier.name }}</h4>
                      <p class="pmc-sub">{{ tier.sub }}</p>
                    </div>
                    <ul class="pmc-list">
                      <li v-for="item in tier.includes" :key="item">
                        <i class="fa-solid fa-circle-check"></i> {{ item }}
                      </li>
                    </ul>
                    <router-link to="/contact" class="default-btn pmc-btn">Get a Quote</router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ── Surcharges Explained ───────────────────────────────────────────── -->
    <section class="padding">
      <div class="container">
        <div class="section-heading text-center mb-40">
          <h3 class="sub-heading is-border border-anim">Full Transparency<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Surcharges &amp;<br><span class="hl">Accessorials, Explained</span></h2>
          <p style="max-width:600px;margin:0 auto;">All surcharges are itemised on your quotation. Here's what each one means.</p>
        </div>
        <div class="row gy-3">
          <div class="col-lg-4 col-md-6" v-for="s in surcharges" :key="s.code">
            <div class="surcharge-card wow fade-in-bottom" :data-wow-delay="s.delay">
              <div class="sc-code">{{ s.code }}</div>
              <div class="sc-body">
                <h4>{{ s.name }}</h4>
                <p>{{ s.desc }}</p>
                <span class="sc-mode">{{ s.modes }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ── Service Tiers ──────────────────────────────────────────────────── -->
    <section class="pricing-section bg-grey padding">
      <div class="map-pattern"></div>
      <div class="container">
        <div class="section-heading text-center mb-40">
          <h3 class="sub-heading is-border border-anim">Choose Your Service Level<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Simple, Scalable<br><span class="hl">Logistics Plans</span></h2>
        </div>
        <div class="row gx-5">
          <div class="col-lg-4 col-md-6 sm-padding" v-for="plan in servicePlans" :key="plan.id">
            <div class="pricing-item" :class="{ featured: plan.featured }">
              <div v-if="plan.featured" class="pricing-badge">Recommended</div>
              <div class="pricing-head">
                <i :class="plan.icon"></i>
                <h3>{{ plan.title }}</h3>
                <h2>{{ plan.price }}<span>{{ plan.unit }}</span></h2>
              </div>
              <ul class="pricing-list">
                <li v-for="feature in plan.features" :key="feature">{{ feature }}</li>
              </ul>
              <div class="pricing-footer">
                <router-link to="/contact" class="default-btn">Get a Quote</router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ── Pricing FAQs ───────────────────────────────────────────────────── -->
    <section class="padding">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="section-heading text-center mb-40">
              <h3 class="sub-heading is-border border-anim">Pricing Questions<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
              <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Common <span class="hl">Pricing FAQs</span></h2>
            </div>
            <div class="accordion faq-accordion" id="pricing-faq">
              <div class="accordion-item" v-for="faq in pricingFaqs" :key="faq.id">
                <h2 class="accordion-header">
                  <button
                    class="accordion-button"
                    :class="{ collapsed: openFaq !== faq.id }"
                    type="button"
                    @click="openFaq = openFaq === faq.id ? null : faq.id"
                  >{{ faq.q }}</button>
                </h2>
                <div class="accordion-collapse collapse" :class="{ show: openFaq === faq.id }">
                  <div class="accordion-body"><p>{{ faq.a }}</p></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ── CTA ───────────────────────────────────────────────────────────── -->
    <section class="cta-section padding-bottom">
      <div class="container">
        <div class="row cta-wrapper gx-0">
          <div class="col-lg-6">
            <div class="section-heading white">
              <h3 class="sub-heading is-border border-anim">Ready to Ship?<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
              <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Get Your Custom<br>Freight <span class="hl">Quote Today!</span></h2>
              <router-link to="/contact" class="default-btn wow fade-in-bottom" data-wow-delay="200ms">Request a Quote</router-link>
            </div>
          </div>
          <div class="cta-men wow fade-in-bottom" data-wow-delay="200ms"></div>
        </div>
        <div class="row promo-item-wrapper gx-0">
          <div class="col-lg-4"><div class="promo-item"><i class="logis logis-truck-3"></i><div class="promo-content"><h3>Land Transport</h3><p>FTL, LTL and express road freight solutions.</p></div></div></div>
          <div class="col-lg-4"><div class="promo-item"><i class="logis logis-cruise"></i><div class="promo-content"><h3>Ocean Freight</h3><p>FCL &amp; LCL with live vessel tracking.</p></div></div></div>
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

useTemplateInit()

const activeMode = ref('road')
const openFaq = ref(null)

const howItWorks = [
  { title: 'Submit Your Details',  icon: 'logis logis-package',  desc: 'Tell us origin, destination, cargo dimensions, weight, and any special handling requirements.', delay: '100ms' },
  { title: 'We Build Your Quote',  icon: 'logis logis-map-1',    desc: 'Our team calculates base rate, surcharges, and options across relevant transport modes.', delay: '200ms' },
  { title: 'Compare & Choose',     icon: 'logis logis-loader',   desc: 'Review itemised quotes across service levels and select the one that fits your timeline and budget.', delay: '300ms' },
  { title: 'Ship with Confidence', icon: 'logis logis-worldwide',desc: 'We handle pickup, documentation, customs, linehaul and delivery — end to end.', delay: '400ms' },
]

const modes = [
  {
    id: 'road', label: 'Land Transport', icon: 'logis logis-truck-2',
    title: 'Land Transport Pricing',
    intro: 'Road freight rates are calculated per consignment based on weight, volume, distance, and service type. Contracted customers receive lane-specific rates valid for agreed periods.',
    factors: [
      'Chargeable weight (actual vs. volumetric — L×W×H÷3,000 for road)',
      'Origin and destination (distance and lane complexity)',
      'FTL vs. LTL (dedicated vs. shared truck)',
      'Cargo type (standard, temperature-controlled, hazardous)',
      'Transit time requirement (standard 1-5 days vs. express next-day)',
      'Fuel Surcharge (FSC) — updated monthly',
    ],
    tiers: [
      { name: 'LTL Groupage', sub: 'Shared load, best value', featured: false, includes: ['Per freight-ton pricing', 'Hub network delivery', '1–5 business day transit', 'Real-time tracking', 'Proof of delivery'] },
      { name: 'FTL Dedicated', sub: 'Full truck, direct delivery', featured: true, includes: ['Dedicated vehicle capacity', 'Direct origin-to-destination', 'Faster transit times', 'Temperature control option', 'Priority customer support'] },
    ],
  },
  {
    id: 'air', label: 'Air Freight', icon: 'logis logis-airplane-flying',
    title: 'Air Freight Pricing',
    intro: 'Air freight is priced per chargeable kilogram on origin-destination trade lanes. Rates vary by carrier availability, season, and urgency. All-in quotes include base rate plus applicable surcharges.',
    factors: [
      'Chargeable weight (actual kg vs. volumetric: L×W×H÷6,000)',
      'Trade lane (origin-destination airport pair)',
      'Service class (deferred, standard, express, next-flight-out)',
      'Commodity type (general, pharma, DG, perishables)',
      'Fuel Surcharge (FSC) — updated weekly by carrier',
      'Security Surcharge (SCC) — IATA mandated',
    ],
    tiers: [
      { name: 'Standard Air', sub: 'Reliable, cost-effective', featured: false, includes: ['Chargeable weight basis', '2–5 day ex-works transit', 'All major carrier partnerships', 'Customs clearance', 'Live flight tracking'] },
      { name: 'Express / NFO', sub: 'Time-critical shipments', featured: true, includes: ['Next-flight-out options', '24-48 hour transit', 'Priority boarding guarantee', 'Dedicated handling at origin', 'CO₂-neutral via SAF option'] },
    ],
  },
  {
    id: 'ocean', label: 'Ocean Freight', icon: 'logis logis-cruise',
    title: 'Ocean Freight Pricing',
    intro: 'Ocean rates are quoted per container (FCL) or per freight ton/CBM (LCL). Base ocean rates fluctuate with market demand, carrier capacity, and global events. Surcharges are itemised separately.',
    factors: [
      'Container type and size: 20ft, 40ft, 40ft HC, reefer, open-top, flat-rack',
      'Trade lane (port pair — e.g., Haifa to Shanghai)',
      'FCL vs. LCL (full container vs. groupage)',
      'Bunker Adjustment Factor (BAF) — fuel indexed',
      'Port surcharges: THC, ISPS, B/L fee, delivery order fee',
      'Peak Season Surcharge (PSS) during high-demand windows',
    ],
    tiers: [
      { name: 'LCL Groupage', sub: 'For smaller volumes', featured: false, includes: ['Per CBM / freight ton pricing', 'Weekly departures all lanes', 'CFS handling at both ends', 'Ocean Bridge tracking', 'Flexible booking windows'] },
      { name: 'FCL Standard', sub: 'Full container, your cargo only', featured: true, includes: ['20ft / 40ft / 40ft HC options', 'Negotiated carrier contracts', 'Reefer & special cargo', 'Port-to-door delivery', 'AI-powered delay alerts'] },
    ],
  },
  {
    id: 'project', label: 'Project Logistics', icon: 'logis logis-loader',
    title: 'Project Logistics Pricing',
    intro: 'Project and special cargo pricing is always fully customised. Every project requires a dedicated feasibility study, route survey, and often multi-modal coordination.',
    factors: [
      'Cargo dimensions and total weight (OOG surcharges apply)',
      'Specialised equipment: heavy-lift cranes, flatbeds, bolsters',
      'Route survey and permit costs (per country)',
      'Port or terminal handling for oversized units',
      'On-site supervision and project management fees',
      'Insurance — typically 0.3–0.5% of declared cargo value',
    ],
    tiers: [
      { name: 'Breakbulk', sub: 'Heavy, oversized cargo', featured: false, includes: ['OOG handling expertise', 'Route engineering', 'Permit coordination', 'Stevedoring supervision', 'Marine warranty surveys'] },
      { name: 'Full Project', sub: 'End-to-end management', featured: true, includes: ['Dedicated project manager', 'Multi-modal optimisation', 'Customs & compliance', 'On-site personnel', 'Risk & insurance mgmt'] },
    ],
  },
]

const surcharges = [
  { code: 'FSC',  name: 'Fuel Surcharge',             desc: 'Indexed monthly to fuel market prices. Applied to all modes. Shown as a per-kg or percentage rate.', modes: 'All modes', delay: '100ms' },
  { code: 'BAF',  name: 'Bunker Adjustment Factor',    desc: 'Ocean-specific fuel surcharge, tied to Very Low Sulphur Fuel Oil (VLSFO) price benchmarks.', modes: 'Ocean Freight', delay: '150ms' },
  { code: 'SCC',  name: 'Security Surcharge',          desc: 'Mandatory IATA security screening and cargo inspection charge applied to all air freight.', modes: 'Air Freight', delay: '200ms' },
  { code: 'THC',  name: 'Terminal Handling Charge',    desc: 'Port or terminal charge for container handling at origin and destination. Charged per container or per freight ton.', modes: 'Ocean / Road', delay: '250ms' },
  { code: 'PSS',  name: 'Peak Season Surcharge',       desc: 'Applied during high-demand periods (typically pre-Golden Week, pre-Christmas). Varies by carrier and lane.', modes: 'Ocean / Air', delay: '300ms' },
  { code: 'AMS',  name: 'Advance Manifest Surcharge',  desc: 'US Customs requires advance electronic filing (AMS/ACI/ENS). Fee covers document preparation and submission.', modes: 'Ocean Freight', delay: '350ms' },
  { code: 'DD',   name: 'Delivery Order Fee',          desc: 'Carrier\'s charge for releasing the delivery order to the consignee upon arrival at destination port.', modes: 'Ocean Freight', delay: '400ms' },
  { code: 'INS',  name: 'Cargo Insurance',             desc: 'Optional. Typically 0.3–0.5% of declared cargo value for all-risk cover. Strongly recommended for high-value goods.', modes: 'All modes', delay: '450ms' },
  { code: 'OOG',  name: 'Out-of-Gauge Surcharge',      desc: 'Applied when cargo dimensions exceed standard container profiles. Covers specialised equipment and handling.', modes: 'Ocean / Project', delay: '500ms' },
]

const servicePlans = [
  {
    id: 1, title: 'Standard', icon: 'logis logis-truck-2', price: 'Quote', unit: ' on request', featured: false,
    features: [
      'Road, Ocean or Air freight',
      'Standard transit times',
      'Customs brokerage included',
      'Online shipment tracking',
      'Email status notifications',
      'Proof of delivery',
    ],
  },
  {
    id: 2, title: 'Priority', icon: 'logis logis-worldwide', price: 'Quote', unit: ' on request', featured: true,
    features: [
      'All Standard features',
      'Faster transit options',
      'Priority capacity allocation',
      'Dedicated account manager',
      'Proactive exception alerts',
      'CO₂ offset via ecovative',
    ],
  },
  {
    id: 3, title: 'Contract', icon: 'logis logis-loader', price: 'Fixed', unit: ' lane rates', featured: false,
    features: [
      'All Priority features',
      'Locked rates for agreed term',
      'Volume-based discounts',
      'SLA-backed transit times',
      'Monthly KPI reporting',
      'Customs & compliance support',
    ],
  },
]

const pricingFaqs = [
  { id: 1, q: 'Do you publish freight rate sheets?', a: 'No — logistics pricing is too dynamic for static rate sheets. Rates depend on live carrier capacity, fuel prices, trade lane demand, and your specific cargo. Every quote is built fresh and reflects current market conditions, ensuring you get an accurate rather than indicative price.' },
  { id: 2, q: 'What is chargeable weight?', a: 'Chargeable weight is whichever is greater: actual gross weight, or volumetric (dimensional) weight. For air freight, volumetric = (L×W×H in cm) ÷ 6,000 kg. For road, ÷ 3,000. For ocean LCL, it is the greater of tonnes or CBM. This ensures light but bulky cargo is fairly priced.' },
  { id: 3, q: 'How often do surcharges change?', a: 'Fuel surcharges are typically revised monthly or quarterly, tracked to published fuel indices. Carrier surcharges (BAF, GRI, PSS) change with carrier announcements — sometimes with as little as 30 days notice. Contracted customers benefit from fixed surcharge components for the contract period.' },
  { id: 4, q: 'Can I lock in a rate for future shipments?', a: 'Yes. Contract customers can lock in origin-destination lane rates for 3, 6, or 12 months depending on volume commitments and carrier agreements. Spot quotes are valid for a defined period (typically 7–14 days) and subject to space availability at time of booking.' },
  { id: 5, q: 'Is customs clearance included in the freight quote?', a: 'Customs clearance fees can be included or quoted separately — we offer both options. An all-in quote covers ocean/air/road freight + origin charges + customs clearance + delivery. This is the most transparent option and avoids invoice surprises. Ask your quotation to specify "DDP" (Delivered Duty Paid) terms if you want everything included.' },
]
</script>

<style scoped>
/* Force accordion body text visible — Tailwind Preflight resets CSS color vars */
.accordion-body {
  background-color: #ffffff !important;
}
.accordion-body p {
  color: #333333 !important;
  font-size: 17px;
  line-height: 1.65;
  margin-bottom: 0;
}

/* ── Mode Pricing Cards ───────────────────────────────────────────────────── */
.pricing-mode-card {
  background: #fff;
  border-radius: 10px;
  padding: 24px 20px;
  border: 2px solid #eee;
  height: 100%;
  display: flex;
  flex-direction: column;
  transition: border-color .2s, box-shadow .2s;
}
.pricing-mode-card.featured {
  border-color: #e31e24;
  box-shadow: 0 8px 30px rgba(227,30,36,.12);
}
.pmc-head { margin-bottom: 16px; position: relative; }
.pmc-badge {
  display: inline-block;
  background: #e31e24;
  color: #fff;
  font-size: .7rem;
  font-weight: 700;
  padding: 2px 10px;
  border-radius: 20px;
  margin-bottom: 8px;
  letter-spacing: .04em;
  text-transform: uppercase;
}
.pmc-head h4  { font-size: 1.05rem; font-weight: 700; margin: 0 0 4px; }
.pmc-sub      { font-size: .82rem; color: #888; margin: 0; }
.pmc-list     { list-style: none; padding: 0; margin: 0 0 20px; flex: 1; }
.pmc-list li  { font-size: .85rem; color: #444; padding: 5px 0; display: flex; align-items: center; gap: 8px; }
.pmc-list li i { color: #e31e24; font-size: .75rem; }
.pmc-btn      { display: block; text-align: center; width: 100%; padding: 10px; font-size: .85rem; }

/* ── Surcharge Cards ──────────────────────────────────────────────────────── */
.surcharge-card {
  display: flex;
  gap: 14px;
  background: #fff;
  border-radius: 8px;
  padding: 18px;
  border-left: 4px solid #e31e24;
  box-shadow: 0 2px 12px rgba(0,0,0,.06);
}
.sc-code {
  flex-shrink: 0;
  width: 50px;
  height: 50px;
  background: #e31e24;
  color: #fff;
  font-weight: 800;
  font-size: .8rem;
  border-radius: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  letter-spacing: .02em;
}
.sc-body h4   { font-size: .95rem; font-weight: 700; margin: 0 0 4px; }
.sc-body p    { font-size: .82rem; color: #555; margin: 0 0 6px; }
.sc-mode      { font-size: .72rem; font-weight: 600; background: #f5f5f5; color: #888; padding: 2px 8px; border-radius: 4px; }

/* ── Mode Tab Buttons ─────────────────────────────────────────────────────── */
.milestone-tabs { display: flex; gap: 10px; flex-wrap: wrap; }
.milestone-tab-btn {
  padding: 9px 20px;
  background: #f2f2f2;
  border: 2px solid transparent;
  border-radius: 6px;
  font-weight: 700;
  font-size: .88rem;
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

.pricing-factor-heading {
  font-size: .9rem;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: .06em;
  color: #e31e24;
  margin-bottom: 12px;
}
</style>
