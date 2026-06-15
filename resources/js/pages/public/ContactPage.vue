<template>
  <PublicLayout>
    <section class="page-header">
      <div class="container">
        <div class="page-header-info">
          <h4>Contact Us</h4>
          <h2>Get in Touch<br>with <span>Our Team</span></h2>
          <p>Our logistics experts are ready to assist with quotes, shipment enquiries, tracking support, and more.</p>
        </div>
      </div>
    </section>

    <!-- ── Top 3 Cards: Head Office / Customer Service / Emergency ─────────── -->
    <section class="service-section bg-grey padding">
      <div class="container">
        <div class="row gy-4 justify-content-center">

          <!-- Head Office -->
          <div class="col-lg-4 col-md-6">
            <div class="info-card wow fade-in-bottom" data-wow-delay="100ms">
              <div class="ic-icon-wrap ic-blue">
                <i class="fa-light fa-building"></i>
              </div>
              <h3>Head Office</h3>
              <div class="ic-body">
                <p v-if="settings.address">{{ settings.address }}</p>
                <p v-else>DB Schenker Israel</p>
                <a v-if="settings.contactEmail" :href="`mailto:${settings.contactEmail}`" class="ic-email">{{ settings.contactEmail }}</a>
              </div>
              <a
                :href="mapLink"
                target="_blank"
                rel="noopener"
                class="ic-btn ic-btn--blue"
              ><i class="fa-solid fa-location-dot"></i> Find Us on Map</a>
            </div>
          </div>

          <!-- Customer Service -->
          <div class="col-lg-4 col-md-6">
            <div class="info-card wow fade-in-bottom" data-wow-delay="200ms">
              <div class="ic-icon-wrap ic-gold">
                <i class="fa-light fa-headset"></i>
              </div>
              <h3>Customer Service</h3>
              <div class="ic-body">
                <p>Available Sun – Thu: 08:00–17:00</p>
                <p>Fri: 08:00–13:00 | Sat: Closed</p>
                <a v-if="settings.contactEmail" :href="`mailto:${settings.contactEmail}`" class="ic-email">{{ settings.contactEmail }}</a>
              </div>
              <a
                v-if="settings.contactEmail"
                :href="`mailto:${settings.contactEmail}`"
                class="ic-btn ic-btn--dark"
              ><i class="fa-regular fa-envelope"></i> Send Email</a>
            </div>
          </div>

          <!-- Emergency Contact -->
          <div class="col-lg-4 col-md-6">
            <div class="info-card wow fade-in-bottom" data-wow-delay="300ms">
              <div class="ic-icon-wrap ic-red">
                <i class="fa-light fa-triangle-exclamation"></i>
              </div>
              <h3>Emergency Contact</h3>
              <div class="ic-body">
                <p>For urgent shipment issues</p>
                <p>Available 24/7</p>
                <a v-if="settings.contactEmail" :href="`mailto:${settings.contactEmail}`" class="ic-email ic-email--red">{{ settings.contactEmail }}</a>
              </div>
              <a
                v-if="settings.phone"
                :href="`mailto:${settings.contactEmail}`"
                class="ic-btn ic-btn--red"
              ><i class="fa-regular fa-phone"></i> Emergency Contact</a>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ── Main Contact Section ───────────────────────────────────────────── -->
    <section class="contact-section padding">
      <div class="map-pattern"></div>
      <div class="container">
        <div class="row">

          <!-- Form -->
          <div class="col-lg-7 sm-padding">
            <div class="contact-form-wrap row-gap">
              <div class="section-heading mb-30">
                <h3 class="sub-heading is-border border-anim">Send Us a Message<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
                <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">We Respond Within<br><span class="hl">One Business Day</span></h2>
                <p class="text-anim" data-effect="fade-in-bottom" data-ease="power4.out">Whether you need a freight quote, have a tracking question, or want to speak with a logistics consultant — fill in the form and we'll connect you with the right team.</p>
              </div>
              <div class="contact-form">
                <form @submit.prevent="submitContact" class="form-horizontal">
                  <div class="contact-form-group">
                    <div class="form-field"><input type="text" v-model="form.firstname" class="form-control" placeholder="First Name" required></div>
                    <div class="form-field"><input type="text" v-model="form.lastname" class="form-control" placeholder="Last Name" required></div>
                    <div class="form-field"><input type="email" v-model="form.email" class="form-control" placeholder="Email Address" required></div>
                    <div class="form-field"><input type="tel" v-model="form.phone" class="form-control" placeholder="Phone Number" required></div>
                    <div class="form-field">
                      <select v-model="form.subject" class="form-control" required>
                        <option value="">Select Enquiry Type</option>
                        <option>Freight Quote Request</option>
                        <option>Shipment Tracking Issue</option>
                        <option>Customs &amp; Documentation</option>
                        <option>Carrier / Partnership Enquiry</option>
                        <option>Complaints &amp; Claims</option>
                        <option>General Information</option>
                      </select>
                    </div>
                    <div class="form-field"><input type="text" v-model="form.company" class="form-control" placeholder="Company Name (optional)"></div>
                    <div class="form-field message"><textarea v-model="form.message" rows="5" class="form-control" placeholder="Describe your request or question in detail…" required></textarea></div>
                    <div class="form-field submit-btn">
                      <button class="default-btn" type="submit" :disabled="sending">
                        <i class="fa-regular fa-paper-plane" style="margin-right:6px;"></i>{{ sending ? 'Sending…' : 'Send Message' }}
                      </button>
                    </div>
                  </div>
                  <div v-if="formMsg" class="ajax-form-msg alert mt-2" :class="formError ? 'alert-danger' : 'alert-success'" role="alert">{{ formMsg }}</div>
                </form>
              </div>
            </div>
          </div>

          <!-- Info panel -->
          <div class="col-lg-5 sm-padding">
            <div class="section-heading mb-30">
              <h3 class="sub-heading is-border border-anim">Contact Details<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
              <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Reach Us<br><span class="hl">Directly</span></h2>
            </div>

            <ul class="contact-info-list">
              <li v-if="settings.phone" class="wow fade-in-bottom" data-wow-delay="100ms">
                <i class="fa-light fa-phone-volume"></i>
                <h3>
                  Main Office Line
                  <span style="display:flex;flex-direction:column;gap:8px;align-items:flex-start;margin-top:4px;">
                    <a :href="`tel:${settings.phone}`">{{ settings.phone }}</a>
                    <a v-if="settings.whatsapp" :href="`https://wa.me/${waNumber}`" class="wa-chip" target="_blank" rel="noopener">
                      <i class="fa-brands fa-whatsapp"></i> WhatsApp
                    </a>
                  </span>
                </h3>
              </li>
              <li v-if="settings.contactEmail" class="wow fade-in-bottom" data-wow-delay="200ms">
                <i class="fa-light fa-envelope-open-text"></i>
                <h3>General Enquiries <span><a :href="`mailto:${settings.contactEmail}`">{{ settings.contactEmail }}</a></span></h3>
              </li>
              <li v-if="settings.address" class="wow fade-in-bottom" data-wow-delay="300ms">
                <i class="fa-light fa-location-dot"></i>
                <h3>Our Office <span>{{ settings.address }}</span></h3>
              </li>
              <li class="wow fade-in-bottom" data-wow-delay="400ms">
                <i class="fa-light fa-clock"></i>
                <h3>Office Hours <span>Sun – Thu: 08:00 – 17:00<br>Fri: 08:00 – 13:00 | Sat: Closed</span></h3>
              </li>
            </ul>

            <!-- Department contacts -->
            <div class="dept-contacts mt-30">
              <div class="dept-title"><h4>Department Contacts</h4></div>
              <div class="dept-item" v-for="dept in departments" :key="dept.name">
                <div class="dept-icon"><i :class="dept.icon"></i></div>
                <div class="dept-info">
                  <h5>{{ dept.name }}</h5>
                  <a :href="`mailto:${dept.email}`" :title="dept.email" class="dept-mailto">
                    <i class="fa-regular fa-envelope"></i> Click to Contact
                  </a>
                </div>
              </div>
            </div>

            <!-- Track shortcut -->
            <div class="track-shortcut mt-30">
              <p>Looking to track a shipment?</p>
              <a href="/track" class="default-btn" style="width:100%;display:block;text-align:center;">
                <i class="fa-regular fa-truck-fast" style="margin-right:6px;"></i>Track Your Shipment
              </a>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ── Dynamic Map from settings.address ─────────────────────────────── -->
    <section class="map-section" style="height:420px;background:#e8e8e8;position:relative;overflow:hidden;">
      <div class="map-overlay">
        <div class="map-pin">
          <i class="fa-solid fa-location-dot"></i>
          <span>{{ settings.address || 'DB Schenker Israel' }}</span>
        </div>
      </div>
      <iframe
        title="DB Schenker Office Location"
        :src="embedMapUrl"
        style="width:100%;height:100%;border:0;filter:grayscale(15%);"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
      ></iframe>
    </section>

    <!-- ── Contact FAQs ──────────────────────────────────────────────────── -->
    <section class="padding">
      <div class="container">
        <div class="section-heading text-center mb-40">
          <h3 class="sub-heading is-border border-anim">Quick Answers<span class="sh-underline"><img class="sh-truck" src="/assets/img/truck.svg" alt="truck"></span></h3>
          <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Frequently Asked<br><span class="hl">Questions</span></h2>
          <p>Quick answers to common questions about our logistics and shipping services.</p>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="contact-faq-list">
              <div
                class="cfaq-item wow fade-in-bottom"
                v-for="(faq, i) in contactFaqs"
                :key="faq.id"
                :data-wow-delay="`${i * 80}ms`"
              >
                <button
                  class="cfaq-trigger"
                  :class="{ open: openFaq === faq.id }"
                  @click="openFaq = openFaq === faq.id ? null : faq.id"
                >
                  <span>{{ faq.q }}</span>
                  <i class="fa-regular fa-chevron-down cfaq-arrow"></i>
                </button>
                <div class="cfaq-body" :class="{ show: openFaq === faq.id }">
                  <p>{{ faq.a }}</p>
                </div>
              </div>
            </div>
            <div class="text-center mt-30">
              <p style="color:#666;font-size:.9rem;">Have a question not listed here?</p>
              <router-link to="/faq" class="default-btn mt-10" style="display:inline-block;">View All FAQs</router-link>
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
              <h2 class="text-anim" data-effect="fade-in-right" data-split="char" data-delay="0.3" data-duration="1">Move Your Cargo<br>With <span class="hl">DB Schenker!</span></h2>
              <a href="/track" class="default-btn wow fade-in-bottom" data-wow-delay="200ms">Track a Shipment</a>
            </div>
          </div>
          <div class="cta-men wow fade-in-bottom" data-wow-delay="200ms"></div>
        </div>
        <div class="row promo-item-wrapper gx-0">
          <div class="col-lg-4"><div class="promo-item"><i class="logis logis-truck-3"></i><div class="promo-content"><h3>Land Transport</h3><p>FTL, LTL and express road solutions.</p></div></div></div>
          <div class="col-lg-4"><div class="promo-item"><i class="logis logis-cruise"></i><div class="promo-content"><h3>Ocean Freight</h3><p>FCL &amp; LCL with AI-powered tracking.</p></div></div></div>
          <div class="col-lg-4"><div class="promo-item"><i class="logis logis-airplane-flying"></i><div class="promo-content"><h3>Air Freight</h3><p>Express cargo to 550+ destinations.</p></div></div></div>
        </div>
      </div>
    </section>

  </PublicLayout>
</template>

<script setup>
import { ref, computed } from 'vue'
import PublicLayout from '../../layouts/PublicLayout.vue'
import { useTemplateInit } from '../../composables/useTemplateInit.js'
import { useSettingsStore } from '../../stores/useSettingsStore.js'
import api from '../../api/index.js'

useTemplateInit()

const settings = useSettingsStore()
const waNumber = computed(() => (settings.whatsapp || '').replace(/\D/g, ''))

const embedMapUrl = computed(() => {
  const addr = settings.address || 'Tel Aviv, Israel'
  return `https://maps.google.com/maps?q=${encodeURIComponent(addr)}&t=&z=15&ie=UTF8&iwloc=&output=embed`
})

const mapLink = computed(() => {
  const addr = settings.address || 'Tel Aviv, Israel'
  return `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(addr)}`
})

const departments = computed(() => {
  const fallback = settings.contactEmail || 'info@dbschenker.com'
  return [
    { name: 'Air Freight',        icon: 'logis logis-airplane-flying', email: fallback },
    { name: 'Ocean Freight',      icon: 'logis logis-cruise',          email: fallback },
    { name: 'Land Transport',     icon: 'logis logis-truck-2',         email: fallback },
    { name: 'Customs Clearance',  icon: 'logis logis-loader',          email: fallback },
    { name: 'Claims & Insurance', icon: 'fa-light fa-shield-check',    email: fallback },
    { name: 'General Support',    icon: 'fa-light fa-headset',         email: fallback },
  ]
})

const openFaq = ref(1)

const contactFaqs = [
  { id: 1,  q: 'How do I track my shipment?',             a: 'Visit our Track page and enter your reference number (AWB for air, B/L for ocean, waybill for road). You\'ll get real-time status updates at every milestone — 24/7. You can also set up email notifications through your account manager.' },
  { id: 2,  q: 'What shipping services do you offer?',    a: 'DB Schenker provides a full range of freight services: Land Transport (FTL, LTL), Air Freight (express, standard, charter), Ocean Freight (FCL, LCL, reefer), Intermodal solutions, Project Logistics for complex cargo, Carrier Business, and Cargo Insurance.' },
  { id: 3,  q: 'How do I get a shipping quote?',          a: 'Fill in the contact form on this page, select "Freight Quote Request" as your enquiry type, and describe your shipment details. You can also call our main office directly. We will provide a detailed, itemised quote within one business day.' },
  { id: 4,  q: 'Do you handle customs clearance?',        a: 'Yes. Our certified customs brokers handle import and export clearance in Israel and across all our global markets — including tariff classification, duty calculation, document submission, and direct liaison with customs authorities.' },
  { id: 5,  q: 'Can you ship dangerous or hazardous goods?', a: 'Yes. DB Schenker is IATA DG certified for air and IMDG certified for ocean. Dangerous goods require advance notice, specific documentation (SDS, DG declarations), and compliant packaging. Please contact us before booking any DG shipment.' },
  { id: 6,  q: 'What are your office hours?',             a: 'Our office is open Sunday to Thursday, 08:00–17:00, and Friday 08:00–13:00. We are closed on Saturday. For urgent shipment issues outside office hours, use the Emergency Contact email listed above — monitored 24/7.' },
]

const sending   = ref(false)
const formMsg   = ref('')
const formError = ref(false)
const form = ref({ firstname: '', lastname: '', email: '', phone: '', subject: '', company: '', message: '' })

async function submitContact() {
  formMsg.value   = ''
  formError.value = false

  const f = form.value
  if (!f.firstname.trim() || !f.lastname.trim() || !f.email.trim() || !f.phone.trim() || !f.subject || !f.message.trim()) {
    formMsg.value   = 'Please fill in all required fields and select an enquiry type.'
    formError.value = true
    return
  }

  sending.value = true
  try {
    const { data } = await api.post('/contact', form.value)
    formMsg.value = data.message
    form.value = { firstname: '', lastname: '', email: '', phone: '', subject: '', company: '', message: '' }
  } catch (err) {
    const errors = err?.response?.data?.errors
    if (errors) {
      formMsg.value = Object.values(errors).flat().join(' ')
    } else {
      formMsg.value = err?.response?.data?.message || 'Something went wrong. Please try again or contact us directly.'
    }
    formError.value = true
  } finally {
    sending.value = false
  }
}
</script>

<style scoped>
/* ── Info Cards (Head Office / Customer Service / Emergency) ──────────────── */
.info-card {
  background: #fff;
  border-radius: 12px;
  padding: 36px 28px;
  text-align: center;
  box-shadow: 0 6px 24px rgba(0,0,0,.08);
  height: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 4px;
  transition: box-shadow .25s, transform .25s;
}
.info-card:hover { box-shadow: 0 12px 36px rgba(0,0,0,.14); transform: translateY(-4px); }

.ic-icon-wrap {
  width: 64px; height: 64px;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.6rem;
  margin-bottom: 16px;
  flex-shrink: 0;
}
.ic-blue  { background: #e8f0fe; color: #1a56db; }
.ic-gold  { background: #fef3c7; color: #b45309; }
.ic-red   { background: #fee2e2; color: #dc2626; }

.info-card h3 { font-size: 1.1rem; font-weight: 800; color: #1a1a2e; margin-bottom: 12px; }

.ic-body { flex: 1; }
.ic-body p { font-size: .86rem; color: #666; margin: 0 0 4px; line-height: 1.5; }
.ic-email { display: block; font-size: .82rem; font-weight: 600; color: #1a56db; text-decoration: none; margin-top: 8px; word-break: break-all; }
.ic-email--red { color: #dc2626; }
.ic-email:hover { text-decoration: underline; }

.ic-btn {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 10px 22px;
  border-radius: 8px;
  font-size: .85rem; font-weight: 700;
  color: #fff; text-decoration: none;
  margin-top: 18px;
  transition: opacity .2s, transform .15s;
}
.ic-btn:hover { opacity: .88; transform: translateY(-1px); color: #fff; }
.ic-btn--blue { background: #1a56db; }
.ic-btn--dark { background: #1a1a2e; }
.ic-btn--red  { background: #dc2626; }

/* ── Contact FAQ ──────────────────────────────────────────────────────────── */
.contact-faq-list { display: flex; flex-direction: column; gap: 10px; }

.cfaq-item {
  border: 1px solid #e5e7eb;
  border-radius: 10px;
  overflow: hidden;
  background: #fff;
  box-shadow: 0 1px 6px rgba(0,0,0,.05);
}

.cfaq-trigger {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  padding: 18px 24px;
  background: #fff;
  border: none;
  text-align: left;
  font-size: .95rem;
  font-weight: 700;
  color: #1a1a2e;
  cursor: pointer;
  gap: 16px;
  transition: background .18s;
}
.cfaq-trigger:hover { background: #fafafa; }
.cfaq-trigger.open  { background: #fff9f9; color: #e31e24; }

.cfaq-arrow {
  flex-shrink: 0;
  font-size: .85rem;
  color: #e31e24;
  transition: transform .25s ease;
}
.cfaq-trigger.open .cfaq-arrow { transform: rotate(180deg); }

.cfaq-body {
  max-height: 0;
  overflow: hidden;
  transition: max-height .3s ease, padding .3s ease;
  padding: 0 24px;
  background: #ffffff;
  border-top: 1px solid transparent;
}
.cfaq-body.show {
  max-height: 300px;
  padding: 16px 24px 20px;
  border-top-color: #e5e7eb;
}
.cfaq-body p {
  margin: 0;
  font-size: .88rem;
  color: #333333 !important;
  line-height: 1.65;
}

/* ── Department contacts ──────────────────────────────────────────────────── */
.dept-contacts { background: #f8f8f8; border-radius: 10px; padding: 22px; }
.dept-title h4 { font-size: .9rem; font-weight: 800; text-transform: uppercase; letter-spacing: .06em; color: #e31e24; margin-bottom: 14px; }
.dept-item { display: flex; align-items: center; gap: 12px; padding: 8px 0; border-bottom: 1px solid #eee; }
.dept-item:last-child { border-bottom: none; }
.dept-icon { font-size: 1.1rem; color: #e31e24; width: 28px; text-align: center; }
.dept-info h5 { font-size: .85rem; font-weight: 700; margin: 0 0 4px; }
.dept-mailto {
  display: inline-flex;
  align-items: center;
  gap: 5px;
  font-size: .78rem;
  font-weight: 600;
  color: #e31e24;
  text-decoration: none;
  border: 1px solid #e31e24;
  border-radius: 4px;
  padding: 2px 9px;
  transition: background .18s, color .18s;
}
.dept-mailto:hover {
  background: #e31e24;
  color: #fff;
}

/* ── Track shortcut ───────────────────────────────────────────────────────── */
.track-shortcut p { font-size: .88rem; color: #666; margin-bottom: 10px; }

/* ── Map overlay ──────────────────────────────────────────────────────────── */
.map-pin {
  position: absolute;
  z-index: 2;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -70%);
  background: #e31e24;
  color: #fff;
  padding: 8px 18px;
  border-radius: 30px;
  font-weight: 700;
  font-size: .88rem;
  display: flex;
  align-items: center;
  gap: 8px;
  box-shadow: 0 4px 16px rgba(227,30,36,.4);
}
.map-pin i { font-size: 1rem; }

/* ── Misc ─────────────────────────────────────────────────────────────────── */
.contact-info-list a { color: inherit; text-decoration: none; }
.contact-info-list a:hover { text-decoration: underline; }
.wa-chip {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  background: #25d366;
  color: #fff !important;
  font-size: 0.72rem;
  padding: 2px 9px;
  border-radius: 20px;
  margin-left: 8px;
  font-weight: 700;
  text-decoration: none !important;
  vertical-align: middle;
}
.wa-chip:hover { background: #1da355; }
</style>
