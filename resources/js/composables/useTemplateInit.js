import { onMounted, onUnmounted } from 'vue'

export function useTemplateInit(options = {}) {
    const swiperInstances = []

    onMounted(() => {
        if (typeof $ === 'undefined') return

        // Responsive body class
        function applyResponsiveClass() {
            if ($(window).width() < 992) {
                $('body').removeClass('viewport-lg').addClass('viewport-sm')
            } else {
                $('body').removeClass('viewport-sm').addClass('viewport-lg')
            }
        }
        applyResponsiveClass()
        $(window).on('resize.templateInit', applyResponsiveClass)

        // Running scroller text duplication
        document.querySelectorAll('.scroller').forEach(scroller => {
            if (scroller.dataset.animated) return
            scroller.setAttribute('data-animated', 'true')
            const inner = scroller.querySelector('.scroller__inner')
            if (!inner) return
            Array.from(inner.children).forEach(item => {
                const clone = item.cloneNode(true)
                clone.setAttribute('aria-hidden', 'true')
                inner.appendChild(clone)
            })
        })

        // Scroll to top
        $(window).on('scroll.templateInit', function () {
            if ($(this).scrollTop() > 100) {
                $('#scrollup').removeClass('hide').addClass('show')
            } else {
                $('#scrollup').removeClass('show').addClass('hide')
            }
        })
        $('#scroll-top').off('click.templateInit').on('click.templateInit', function () {
            document.documentElement.scrollTo({ top: 0, behavior: 'smooth' })
        })

        // Odometer counters via waypoints
        if (typeof Waypoint !== 'undefined') {
            $('.counter-item').waypoint(function () {
                $('.counter-item .odometer').each(function () {
                    $(this).html($(this).data('count'))
                })
            }, { offset: '80%', triggerOnce: true })
        }

        // WOW animations
        if (typeof WOW !== 'undefined') {
            new WOW({ live: false }).init()
        }

        // Nice Select
        if ($.fn.niceSelect) {
            $('select').niceSelect()
        }

        // Venobox
        if ($.fn.venobox) {
            $('.venobox').venobox({
                bgcolor: 'transparent',
                spinner: 'spinner-pulse',
                numeration: true,
                infinigall: true,
            })
        }

        // GSAP text animations
        if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
            gsap.registerPlugin(ScrollTrigger)
            document.querySelectorAll('.section-heading').forEach(section => {
                section.querySelectorAll('.text-anim').forEach((el, i) => {
                    const effect = el.dataset.effect || 'fade-in-bottom'
                    const duration = parseFloat(el.dataset.duration || 1)
                    const delay = parseFloat(el.dataset.delay || 0.3)
                    const ease = el.dataset.ease || 'Back.easeOut'

                    const tl = gsap.timeline({
                        scrollTrigger: {
                            trigger: el,
                            start: 'top 90%',
                            toggleActions: 'play none none none',
                        },
                    })

                    let target = el
                    const split = el.dataset.split
                    if (split && split !== 'none' && typeof SplitType !== 'undefined') {
                        const st = new SplitType(el, { types: 'chars,words,lines' })
                        target = el.querySelectorAll(`.${split}`)
                    }

                    const fromMap = {
                        'fade-in-bottom': { y: 20, opacity: 0 },
                        'fade-in-top': { y: -20, opacity: 0 },
                        'fade-in-left': { x: -20, opacity: 0 },
                        'fade-in-right': { x: 50, opacity: 0 },
                        'fade-in': { y: 40, opacity: 0 },
                    }
                    const toMap = {
                        'fade-in-bottom': { y: 0, opacity: 1 },
                        'fade-in-top': { y: 0, opacity: 1 },
                        'fade-in-left': { x: 0, opacity: 1 },
                        'fade-in-right': { x: 0, opacity: 1 },
                        'fade-in': { y: 0, opacity: 1 },
                    }

                    if (fromMap[effect]) {
                        gsap.set(target, fromMap[effect])
                        tl.to(target, { ...toMap[effect], duration, delay, ease, stagger: 0.02 })
                    }

                    const hl = el.querySelectorAll('.hl')
                    if (hl.length) {
                        tl.to(hl, { '--hl-bd-width': '100%', duration: 0.8, delay: 0.2 }, '-=1')
                    }
                })

                // Border animation (sub-heading underline)
                section.querySelectorAll('.border-anim').forEach(el => {
                    const line = el.querySelector('.sh-underline')
                    const truck = el.querySelector('.sh-truck')
                    if (!line) return
                    gsap.set(line, { width: '0%' })
                    if (truck) gsap.set(truck, { opacity: 0, right: '20px' })

                    const tl = gsap.timeline({
                        scrollTrigger: { trigger: el, start: 'top 90%', toggleActions: 'play none none none' },
                    })
                    tl.to(line, { width: '100%', duration: 1, ease: 'power1.in' })
                    if (truck) tl.to(truck, { opacity: 1, right: 0, duration: 1, delay: -0.08, ease: 'Back.easeOut' })
                })
            })
        }

        // Page-specific Swiper instances
        if (typeof Swiper !== 'undefined') {
            // Main hero slider
            const mainSliderEl = document.querySelector('.main-slider')
            if (mainSliderEl) {
                const slider = new Swiper('.main-slider', {
                    speed: 1500,
                    autoplay: { delay: 5000 },
                    loop: true,
                    effect: 'fade',
                    initialSlide: 0,
                    pagination: { el: '.slider-pagination', clickable: true },
                })
                swiperInstances.push(slider)
            }

            // Service carousel (4-per-view swipeable grid)
            const serviceCarouselEl = document.querySelector('.service-carousel')
            if (serviceCarouselEl) {
                const svc = new Swiper('.service-carousel', {
                    slidesPerView: 4,
                    spaceBetween: 24,
                    loop: true,
                    pagination: { el: '.service-carousel .service-pagination', clickable: true },
                    navigation: { nextEl: '.service-carousel-next', prevEl: '.service-carousel-prev' },
                    breakpoints: {
                        320:  { slidesPerView: 1, spaceBetween: 16 },
                        576:  { slidesPerView: 2, spaceBetween: 16 },
                        992:  { slidesPerView: 3, spaceBetween: 20 },
                        1200: { slidesPerView: 4, spaceBetween: 24 },
                    },
                })
                swiperInstances.push(svc)
            }

            // Project carousel
            const projectCarouselEl = document.querySelector('.project-carousel')
            if (projectCarouselEl) {
                const proj = new Swiper('.project-carousel', {
                    slidesPerView: 3,
                    spaceBetween: 20,
                    loop: true,
                    pagination: { el: '.project-carousel .carousel-pagination', clickable: true },
                    navigation: { nextEl: '.swiper-next', prevEl: '.swiper-prev' },
                    breakpoints: { 320: { slidesPerView: 1 }, 767: { slidesPerView: 2 }, 1024: { slidesPerView: 4 } },
                })
                swiperInstances.push(proj)
            }

            // Testimonial carousel
            const testiEl = document.querySelector('.testimonial-carousel')
            if (testiEl) {
                const testi = new Swiper('.testimonial-carousel', {
                    slidesPerView: 2,
                    spaceBetween: 20,
                    loop: true,
                    pagination: { el: '.testimonial-carousel .carousel-pagination', clickable: true },
                    navigation: { nextEl: '.swiper-next', prevEl: '.swiper-prev' },
                    breakpoints: { 320: { slidesPerView: 1 }, 767: { slidesPerView: 1 }, 1024: { slidesPerView: 2 } },
                })
                swiperInstances.push(testi)
            }

            // Sponsor carousel
            const sponsorEl = document.querySelector('.sponsor-carousel')
            if (sponsorEl) {
                const sponsor = new Swiper('.sponsor-carousel', {
                    spaceBetween: 60,
                    loop: true,
                    autoplay: true,
                    speed: 1500,
                    breakpoints: { 320: { slidesPerView: 2, spaceBetween: 20 }, 767: { slidesPerView: 2, spaceBetween: 50 }, 1024: { slidesPerView: 5 } },
                })
                swiperInstances.push(sponsor)
            }
        }

        // Current year
        const yrEl = document.getElementById('currentYear')
        if (yrEl) yrEl.textContent = new Date().getFullYear()
    })

    onUnmounted(() => {
        swiperInstances.forEach(s => { try { s.destroy(true, true) } catch (_) {} })
        swiperInstances.length = 0
        if (typeof $ !== 'undefined') {
            $(window).off('.templateInit')
            if (typeof Waypoint !== 'undefined') Waypoint.destroyAll()
            if (typeof ScrollTrigger !== 'undefined') ScrollTrigger.getAll().forEach(t => t.kill())
        }
    })
}
