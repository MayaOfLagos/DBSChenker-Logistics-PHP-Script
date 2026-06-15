import { createRouter, createWebHistory } from 'vue-router'

const routes = [
    // ─── Public website (Logisko template) ───────────────────────────────────
    {
        path: '/',
        name: 'home',
        component: () => import('../pages/public/HomePage.vue'),
        meta: { title: 'Home' },
    },
    {
        path: '/about',
        name: 'about',
        component: () => import('../pages/public/AboutPage.vue'),
        meta: { title: 'About Us' },
    },
    {
        path: '/company',
        name: 'company',
        component: () => import('../pages/public/CompanyPage.vue'),
        meta: { title: 'Company' },
    },
    {
        path: '/services/logistics',
        name: 'services-logistics',
        component: () => import('../pages/public/ServicesLogisticPage.vue'),
        meta: { title: 'Logistic Services' },
    },
    {
        path: '/services/transport',
        name: 'services-transport',
        component: () => import('../pages/public/ServicesTransportPage.vue'),
        meta: { title: 'Transport Services' },
    },
    {
        path: '/services/details',
        name: 'service-details',
        component: () => import('../pages/public/ServiceDetailsPage.vue'),
        meta: { title: 'Service Details' },
    },
    {
        path: '/business/:slug',
        name: 'business-service',
        component: () => import('../pages/public/BusinessServicePage.vue'),
        meta: { title: 'Business Services' },
    },
    {
        path: '/projects',
        name: 'projects',
        component: () => import('../pages/public/ProjectsPage.vue'),
        meta: { title: 'Our Projects' },
    },
    {
        path: '/projects/details',
        name: 'project-details',
        component: () => import('../pages/public/ProjectDetailsPage.vue'),
        meta: { title: 'Project Details' },
    },
    {
        path: '/blog',
        name: 'blog',
        component: () => import('../pages/public/BlogPage.vue'),
        meta: { title: 'Blog' },
    },
    {
        path: '/blog/details',
        name: 'blog-details',
        component: () => import('../pages/public/BlogDetailsPage.vue'),
        meta: { title: 'Blog Details' },
    },
    {
        path: '/team',
        name: 'team',
        component: () => import('../pages/public/TeamPage.vue'),
        meta: { title: 'Our Team' },
    },
    {
        path: '/team/details',
        name: 'team-details',
        component: () => import('../pages/public/TeamDetailsPage.vue'),
        meta: { title: 'Team Details' },
    },
    {
        path: '/faq',
        name: 'faq',
        component: () => import('../pages/public/FaqPage.vue'),
        meta: { title: 'Help & FAQs' },
    },
    {
        path: '/pricing',
        name: 'pricing',
        component: () => import('../pages/public/PricingPage.vue'),
        meta: { title: 'Plans & Pricing' },
    },
    {
        path: '/testimonials',
        name: 'testimonials',
        component: () => import('../pages/public/TestimonialsPage.vue'),
        meta: { title: 'Testimonials' },
    },
    {
        path: '/contact',
        name: 'contact',
        component: () => import('../pages/public/ContactPage.vue'),
        meta: { title: 'Contact' },
    },

    // ─── 404 catch-all ────────────────────────────────────────────────────────
    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: () => import('../pages/public/NotFoundPage.vue'),
        meta: { title: 'Page Not Found' },
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior: () => ({ top: 0 }),
})

router.afterEach((to) => {
    document.title = to.meta.title
        ? `${to.meta.title} | ${window.__SITE_NAME__ || 'DB Schenker'}`
        : (window.__SITE_NAME__ || 'DB Schenker')
})

export default router
