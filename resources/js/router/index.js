import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    {
        path: '/',
        name: 'track',
        component: () => import('../pages/TrackPage.vue'),
        meta: { title: 'Track Your Shipment' },
    },
    {
        path: '/result',
        name: 'result',
        component: () => import('../pages/TrackResult.vue'),
        meta: { title: 'Tracking Result' },
    },
    {
        path: '/deposits',
        name: 'deposits',
        component: () => import('../pages/DepositPage.vue'),
        meta: { title: 'Make a Payment' },
    },
    {
        path: '/payment',
        name: 'payment',
        component: () => import('../pages/PaymentPage.vue'),
        meta: { title: 'Complete Payment' },
    },
    {
        path: '/receipt/:id?',
        name: 'receipt',
        component: () => import('../pages/ReceiptPage.vue'),
        meta: { title: 'Payment Receipt' },
    },
    {
        path: '/invoice/:id',
        name: 'invoice',
        component: () => import('../pages/InvoicePage.vue'),
        meta: { title: 'Invoice' },
    },
    {
        path: '/printinvoice/:id',
        name: 'printinvoice',
        component: () => import('../pages/PrintInvoice.vue'),
        meta: { title: 'Print Invoice' },
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior: () => ({ top: 0 }),
})

router.afterEach((to) => {
    document.title = to.meta.title
        ? `${to.meta.title} | ${window.__SITE_NAME__ || 'Logistics'}`
        : (window.__SITE_NAME__ || 'Logistics')
})

export default router
