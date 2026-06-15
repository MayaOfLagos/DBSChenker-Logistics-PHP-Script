import { ref, onMounted, onUnmounted } from 'vue'

// DB Schenker was founded in 1872 by Gottfried Schenker in Vienna.
const FOUNDED_YEAR = 1872

// Base delivery count anchored to a fixed date so the number is
// deterministic and consistent across page loads.
const BASE_DATE       = new Date('2026-06-15T00:00:00Z').getTime()
const BASE_DELIVERIES = 1_400       // starting count at base date
const INTERVAL_MS     = 10_000      // +1 every 10 seconds

function calcDeliveries() {
    const elapsedSec = (Date.now() - BASE_DATE) / 1000
    return BASE_DELIVERIES + Math.floor(elapsedSec / (INTERVAL_MS / 1000))
}

export function useLiveStats() {
    const yearsExperience = new Date().getFullYear() - FOUNDED_YEAR
    const deliveryCount   = ref(0)
    let   timer           = null

    onMounted(() => {
        deliveryCount.value = calcDeliveries()
        timer = setInterval(() => { deliveryCount.value += 1 }, INTERVAL_MS)
    })

    onUnmounted(() => {
        if (timer) clearInterval(timer)
    })

    function fmtDeliveries(n) {
        return n.toLocaleString('en-US')
    }

    // Shared stats definition — used by both HomePage and CompanyPage.
    // id 2 has live:true so the template renders the reactive ref instead
    // of the odometer span.
    const stats = [
        { id: 1, icon: 'logis logis-map-1',    count: 130,             suffix: '+',  label: 'Countries Served',      live: false },
        { id: 2, icon: 'logis logis-loader',    count: 0,               suffix: '+',  label: 'Successful Deliveries', live: true  },
        { id: 3, icon: 'logis logis-worldwide', count: yearsExperience, suffix: '',   label: 'Years of Experience',   live: false },
    ]

    return { stats, deliveryCount, fmtDeliveries }
}
