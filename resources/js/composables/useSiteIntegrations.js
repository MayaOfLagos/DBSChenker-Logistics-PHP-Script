import { onMounted, ref } from 'vue'
import { getSettings } from '../api/index.js'

export function useSiteIntegrations() {
    const showTranslate = ref(false)

    onMounted(async () => {
        try {
            const { data } = await getSettings()

            if (data.favicon_url) {
                let link = document.querySelector("link[rel~='icon']")
                if (!link) {
                    link = document.createElement('link')
                    link.rel = 'icon'
                    document.head.appendChild(link)
                }
                link.href = data.favicon_url
            }

            if (data.site_name) {
                window.__SITE_NAME__ = data.site_name
                document.title = data.site_name
            }

            const smartsuppKey = data.smartsupp_key || data.tido
            if (smartsuppKey && !window.smartsupp) {
                window._smartsupp = window._smartsupp || {}
                window._smartsupp.key = smartsuppKey
                window.smartsupp = function () { window.smartsupp._.push(arguments) }
                window.smartsupp._ = []

                const script = document.createElement('script')
                script.type = 'text/javascript'
                script.charset = 'utf-8'
                script.async = true
                script.src = 'https://www.smartsuppchat.com/loader.js?'
                document.body.appendChild(script)
            }

            if (data.google_translate === 'on') {
                showTranslate.value = true

                window.gtranslateSettings = {
                    default_language: 'en',
                    native_language_names: true,
                    detect_browser_language: true,
                    wrapper_selector: '.gtranslate_wrapper',
                }

                if (!document.querySelector('script[data-gtranslate-widget]')) {
                    const script = document.createElement('script')
                    script.src = 'https://cdn.gtranslate.net/widgets/latest/float.js'
                    script.defer = true
                    script.dataset.gtranslateWidget = 'true'
                    document.body.appendChild(script)
                }
            }
        } catch {}
    })

    return { showTranslate }
}
