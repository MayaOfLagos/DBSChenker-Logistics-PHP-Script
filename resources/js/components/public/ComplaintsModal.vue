<template>
  <Teleport to="body">
    <div v-if="show" class="complaint-backdrop" @click.self="$emit('close')">
      <div class="complaint-modal" role="dialog" aria-modal="true" aria-labelledby="complaint-title">
        <button class="complaint-close" @click="$emit('close')" aria-label="Close">
          <i class="fa-regular fa-xmark"></i>
        </button>

        <div class="complaint-header">
          <div class="complaint-icon-wrap">
            <i class="fa-regular fa-shield-exclamation"></i>
          </div>
          <h2 id="complaint-title">Complaints &amp; Compliance</h2>
          <p>Report a service issue or compliance concern. All reports are treated confidentially.</p>
        </div>

        <form v-if="!submitted" @submit.prevent="submit" class="complaint-form" novalidate>
          <div class="cf-row">
            <div class="cf-field">
              <label>Full Name <span>*</span></label>
              <input type="text" v-model="form.name" placeholder="Your full name" required>
            </div>
            <div class="cf-field">
              <label>Email Address <span>*</span></label>
              <input type="email" v-model="form.email" placeholder="your@email.com" required>
            </div>
          </div>
          <div class="cf-row">
            <div class="cf-field">
              <label>Phone (optional)</label>
              <input type="tel" v-model="form.phone" placeholder="+1 555 000 0000">
            </div>
            <div class="cf-field">
              <label>Complaint Type <span>*</span></label>
              <select v-model="form.type" required>
                <option value="">— Select category —</option>
                <option>Delivery / Shipment Issue</option>
                <option>Billing / Payment Dispute</option>
                <option>Customer Service</option>
                <option>Damaged / Lost Goods</option>
                <option>Compliance / Regulatory</option>
                <option>Other</option>
              </select>
            </div>
          </div>
          <div class="cf-field cf-full">
            <label>Tracking Number (if applicable)</label>
            <input type="text" v-model="form.tracking" placeholder="e.g. DBX-123456789">
          </div>
          <div class="cf-field cf-full">
            <label>Details <span>*</span></label>
            <textarea v-model="form.message" rows="5" placeholder="Describe your complaint or concern in detail…" required></textarea>
          </div>
          <div v-if="errorMsg" class="cf-error">{{ errorMsg }}</div>
          <button type="submit" class="cf-submit" :disabled="sending">
            <i class="fa-regular fa-paper-plane-top"></i>
            {{ sending ? 'Submitting…' : 'Submit Complaint' }}
          </button>
        </form>

        <div v-else class="complaint-success">
          <i class="fa-regular fa-circle-check"></i>
          <h3>Report Received</h3>
          <p>Thank you, <strong>{{ form.name }}</strong>. Your complaint has been logged and our compliance team will review it within <strong>2 business days</strong>. A confirmation has been sent to <strong>{{ form.email }}</strong>.</p>
          <button class="cf-submit" @click="reset">Close</button>
        </div>
      </div>
    </div>
  </Teleport>
</template>

<script setup>
import { ref, watch } from 'vue'
import api from '../../api/index.js'

const props = defineProps({ show: Boolean })
const emit  = defineEmits(['close'])

const sending   = ref(false)
const submitted = ref(false)
const errorMsg  = ref('')

const blank = () => ({ name: '', email: '', phone: '', type: '', tracking: '', message: '' })
const form  = ref(blank())

watch(() => props.show, (v) => {
  if (!v) return
  submitted.value = false
  errorMsg.value  = ''
  form.value = blank()
  document.body.classList.add('complaint-modal-open')
}, { immediate: false })

watch(() => props.show, (v) => {
  if (!v) document.body.classList.remove('complaint-modal-open')
})

async function submit() {
  errorMsg.value = ''
  const f = form.value
  if (!f.name.trim() || !f.email.trim() || !f.type || !f.message.trim()) {
    errorMsg.value = 'Please fill in all required fields.'
    return
  }
  sending.value = true
  try {
    await api.post('/complaint', f)
    submitted.value = true
  } catch (err) {
    const errors = err?.response?.data?.errors
    errorMsg.value = errors
      ? Object.values(errors).flat().join(' ')
      : (err?.response?.data?.message || 'Something went wrong. Please try again.')
  } finally {
    sending.value = false
  }
}

function reset() {
  submitted.value = false
  form.value = blank()
  emit('close')
}
</script>

<style scoped>
.complaint-backdrop {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.65);
  z-index: 99999;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1rem;
  backdrop-filter: blur(3px);
}

.complaint-modal {
  background: #fff;
  border-radius: 16px;
  width: 100%;
  max-width: 640px;
  max-height: 90vh;
  overflow-y: auto;
  padding: 2.5rem;
  position: relative;
  box-shadow: 0 25px 60px rgba(0,0,0,0.3);
  animation: modal-in 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) both;
}

@keyframes modal-in {
  from { opacity: 0; transform: scale(0.85) translateY(30px); }
  to   { opacity: 1; transform: scale(1)    translateY(0); }
}

.complaint-close {
  position: absolute;
  top: 1rem;
  right: 1rem;
  background: #f5f5f5;
  border: none;
  border-radius: 50%;
  width: 36px;
  height: 36px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1rem;
  color: #444;
  transition: background 0.2s;
}
.complaint-close:hover { background: #e0e0e0; }

.complaint-header {
  text-align: center;
  margin-bottom: 1.8rem;
}

.complaint-icon-wrap {
  width: 64px;
  height: 64px;
  background: linear-gradient(135deg, #e53935, #c62828);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1rem;
  font-size: 1.6rem;
  color: #fff;
  box-shadow: 0 4px 20px rgba(229, 57, 53, 0.4);
}

.complaint-header h2 {
  font-size: 1.4rem;
  font-weight: 700;
  color: #1a1a2e;
  margin-bottom: 0.4rem;
}

.complaint-header p {
  font-size: 0.9rem;
  color: #666;
}

.complaint-form .cf-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
  margin-bottom: 1rem;
}

.cf-field {
  display: flex;
  flex-direction: column;
  gap: 0.35rem;
}

.cf-field.cf-full {
  margin-bottom: 1rem;
}

.cf-field label {
  font-size: 0.82rem;
  font-weight: 600;
  color: #444;
  text-transform: uppercase;
  letter-spacing: 0.03em;
}

.cf-field label span {
  color: #e53935;
}

.cf-field input,
.cf-field select,
.cf-field textarea {
  border: 1.5px solid #e0e0e0;
  border-radius: 8px;
  padding: 0.65rem 0.9rem;
  font-size: 0.92rem;
  color: #222;
  background: #fafafa;
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
  font-family: inherit;
}

.cf-field input:focus,
.cf-field select:focus,
.cf-field textarea:focus {
  border-color: #e53935;
  box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.12);
  background: #fff;
}

.cf-field textarea { resize: vertical; }

.cf-error {
  background: #fdecea;
  border: 1px solid #f5c6c6;
  border-radius: 8px;
  color: #c62828;
  padding: 0.7rem 1rem;
  font-size: 0.88rem;
  margin-bottom: 1rem;
}

.cf-submit {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  justify-content: center;
  width: 100%;
  padding: 0.85rem;
  background: linear-gradient(135deg, #e53935, #c62828);
  color: #fff;
  border: none;
  border-radius: 10px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: opacity 0.2s, transform 0.1s;
  margin-top: 0.5rem;
}
.cf-submit:hover:not(:disabled) { opacity: 0.9; transform: translateY(-1px); }
.cf-submit:disabled { opacity: 0.6; cursor: not-allowed; }

.complaint-success {
  text-align: center;
  padding: 1rem 0;
}
.complaint-success i {
  font-size: 3.5rem;
  color: #2e7d32;
  margin-bottom: 1rem;
  display: block;
}
.complaint-success h3 {
  font-size: 1.3rem;
  font-weight: 700;
  color: #1a1a2e;
  margin-bottom: 0.8rem;
}
.complaint-success p {
  font-size: 0.93rem;
  color: #555;
  line-height: 1.7;
  margin-bottom: 1.5rem;
}

@media (max-width: 560px) {
  .complaint-modal { padding: 1.8rem 1.2rem; }
  .complaint-form .cf-row { grid-template-columns: 1fr; }
}
</style>
