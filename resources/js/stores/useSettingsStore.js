import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import { getSettings } from '../api/index.js'

export const useSettingsStore = defineStore('settings', () => {
    const data = ref(null)
    const loaded = ref(false)
    const loading = ref(false)

    async function fetch() {
        if (loaded.value || loading.value) return
        loading.value = true
        try {
            const res = await getSettings()
            data.value = res.data
            loaded.value = true
        } catch (e) {
            console.warn('Could not load site settings:', e?.message)
        } finally {
            loading.value = false
        }
    }

    const siteName    = computed(() => data.value?.site_name    ?? 'DB Schenker')
    const siteTitle   = computed(() => data.value?.site_title   ?? '')
    const contactEmail= computed(() => data.value?.contact_email ?? '')
    const phone       = computed(() => data.value?.phone        ?? '')
    const whatsapp    = computed(() => data.value?.whatsapp     ?? '')
    const address     = computed(() => data.value?.locations    ?? '')
    const logoUrl     = computed(() => data.value?.logo_url     ?? null)
    const yearStarted = computed(() => data.value?.year_started ?? new Date().getFullYear())
    const googleTranslate = computed(() => data.value?.google_translate ?? 'off')

    return {
        data, loaded, loading, fetch,
        siteName, siteTitle, contactEmail, phone, whatsapp, address, logoUrl, yearStarted, googleTranslate,
    }
})
