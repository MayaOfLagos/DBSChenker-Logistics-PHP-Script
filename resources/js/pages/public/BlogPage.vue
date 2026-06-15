<template>
  <PublicLayout>
    <section class="page-header">
      <div class="container">
        <div class="page-header-info">
          <h4>News &amp; Insights</h4>
          <h2>Logistics Knowledge<br><span>Hub</span></h2>
          <p>Industry insights, logistics trends, and DB Schenker news — straight from our team of global experts.</p>
        </div>
      </div>
    </section>

    <section class="blog-section blog-page padding">
      <div class="container">
        <div class="row">

          <!-- ── Posts Grid ─────────────────────────────────────────────────── -->
          <div class="col-lg-8 sm-padding">

            <!-- Category filter -->
            <div class="blog-cats mb-30">
              <button
                v-for="cat in blogCats"
                :key="cat"
                class="blog-cat-btn"
                :class="{ active: activeCategory === cat }"
                @click="activeCategory = cat"
              >{{ cat }}</button>
            </div>

            <div class="row gy-4">
              <div class="col-md-6" v-for="post in filteredPosts" :key="post.id">
                <div class="post-card wow fade-in-bottom" :data-wow-delay="post.delay">
                  <div class="post-thumb"><img :src="post.img" alt="post"></div>
                  <div class="post-content-wrap">
                    <a href="#" class="post-date">
                      <time><span>{{ post.day }}</span>{{ post.month }} {{ post.year }}</time>
                    </a>
                    <ul class="post-meta">
                      <li><i class="fa-regular fa-user"></i><a href="#">{{ post.author }}</a></li>
                      <li><i class="fa-sharp fa-regular fa-bookmark"></i><a href="#" @click.prevent="activeCategory = post.category">{{ post.category }}</a></li>
                    </ul>
                    <div class="post-content">
                      <h3><router-link to="/blog/details">{{ post.title }}</router-link></h3>
                      <p>{{ post.excerpt }}</p>
                      <router-link to="/blog/details" class="read-more">Read More</router-link>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div v-if="filteredPosts.length === 0" class="text-center py-5">
              <p>No articles found in this category.</p>
            </div>

            <ul class="pagination-wrap text-center mt-40">
              <li><a href="#"><i class="fa-regular fa-arrow-left"></i></a></li>
              <li><a href="#" class="active">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#"><i class="fa-regular fa-arrow-right"></i></a></li>
            </ul>
          </div>

          <!-- ── Sidebar ─────────────────────────────────────────────────── -->
          <div class="col-lg-4 sm-padding">
            <div class="sidebar-widget search-widget">
              <form @submit.prevent class="search-form">
                <input type="text" v-model="search" class="form-control" placeholder="Search articles…">
                <button class="search-btn" type="button"><i class="fa-regular fa-magnifying-glass"></i></button>
              </form>
            </div>

            <div class="sidebar-widget">
              <div class="widget-title"><h3>Categories</h3></div>
              <ul class="category-list">
                <li v-for="cat in categoryCounts" :key="cat.name">
                  <a href="#" @click.prevent="activeCategory = cat.name === activeCategory ? 'All' : cat.name">{{ cat.name }}</a>
                  <span>{{ cat.count }}</span>
                </li>
              </ul>
            </div>

            <div class="sidebar-widget">
              <div class="widget-title"><h3>Featured Articles</h3></div>
              <ul class="thumb-post">
                <li v-for="p in featuredSidebar" :key="p.id">
                  <div class="thumb"><img :src="p.img" alt="thumb"></div>
                  <div class="thumb-post-info">
                    <h3><router-link to="/blog/details">{{ p.title }}</router-link></h3>
                    <a href="#" class="date">{{ p.month }} {{ p.day }}, {{ p.year }}</a>
                  </div>
                </li>
              </ul>
            </div>

            <div class="sidebar-widget sidebar-banner">
              <router-link to="/contact"><img src="/assets/img/db-schenker-insights-corporate-sustainability-stage.webp" alt="banner"></router-link>
            </div>

            <div class="sidebar-widget">
              <div class="widget-title"><h3>Topics</h3></div>
              <ul class="tags">
                <li v-for="tag in tags" :key="tag">
                  <a href="#" @click.prevent="activeCategory = tag">{{ tag }}</a>
                </li>
              </ul>
            </div>

            <!-- Newsletter sign-up widget -->
            <div class="sidebar-widget">
              <div class="widget-title"><h3>Stay Informed</h3></div>
              <div class="newsletter-widget">
                <p>Get the latest logistics insights and DB Schenker news delivered to your inbox.</p>
                <form @submit.prevent class="newsletter-form">
                  <input type="email" class="form-control" placeholder="Your email address">
                  <button class="default-btn mt-10" type="submit" style="width:100%;text-align:center;display:block;">Subscribe</button>
                </form>
              </div>
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
const activeCategory = ref('All')

const blogCats = ['All', 'Insights', 'Innovation', 'Sustainability', 'Supply Chain', 'Road Freight', 'Air Freight', 'Ocean']

const posts = [
  {
    id: 1,
    title: 'Lost in the Vocabulary of Logistics? We\'ve Got You Covered',
    img: '/assets/img/blog/logistics-terminology.jpg',
    day: '10', month: 'Jun', year: '2025',
    author: 'DB Schenker', category: 'Insights',
    excerpt: 'From AWB to CFS to ETA — logistics is full of abbreviations and jargon. Our comprehensive glossary breaks down the 50 terms every shipper needs to know.',
    delay: '100ms',
  },
  {
    id: 2,
    title: 'e-Shipping and Tracking: Digital Transparency Across the Supply Chain',
    img: '/assets/img/blog/eshipping.jpg',
    day: '27', month: 'May', year: '2025',
    author: 'DB Schenker', category: 'Innovation',
    excerpt: 'Explore how digital shipping tools and real-time tracking are revolutionising transparency and efficiency across global supply chains.',
    delay: '300ms',
  },
  {
    id: 3,
    title: 'The Magic Mix for Freight: Why the Best Solution Isn\'t Always Black and White',
    img: '/assets/img/blog/magic-mix-freight.jpg',
    day: '05', month: 'May', year: '2025',
    author: 'DB Schenker', category: 'Insights',
    excerpt: 'From air to ocean to road — the ideal freight solution is rarely a single mode. Discover how the right mix delivers the best result for cost, speed, and sustainability.',
    delay: '500ms',
  },
  {
    id: 4,
    title: 'Port Operations: Managing Container Terminals at Scale',
    img: '/assets/img/projects/port-terminal.jpg',
    day: '15', month: 'Apr', year: '2025',
    author: 'DB Schenker', category: 'Ocean',
    excerpt: 'Modern container terminals handle millions of TEUs annually. Explore how advanced port management and automation keep global trade moving.',
    delay: '100ms',
  },
  {
    id: 5,
    title: 'Fleet Management: Optimizing Road Freight Across Borders',
    img: '/assets/img/projects/fleet-operations.jpg',
    day: '22', month: 'Mar', year: '2025',
    author: 'DB Schenker', category: 'Road Freight',
    excerpt: 'Efficient fleet management is the backbone of land logistics. Learn how DB Schenker keeps thousands of vehicles moving safely and on time across the region.',
    delay: '300ms',
  },
  {
    id: 6,
    title: 'VoloDrone: DB Schenker and the Future of Heavy-Lift Cargo Drones',
    img: '/assets/img/about/history-2021.jpg',
    day: '10', month: 'Mar', year: '2025',
    author: 'DB Schenker', category: 'Innovation',
    excerpt: 'The first public flight of the VoloDrone heavy-lift cargo drone marked a milestone for autonomous logistics. We look at what it means for the future of last-mile delivery.',
    delay: '500ms',
  },
  {
    id: 7,
    title: 'Sustainable Aviation Fuel (SAF): Our Path to Carbon-Neutral Air Freight',
    img: '/assets/img/team/air-freight.jpg',
    day: '18', month: 'Feb', year: '2025',
    author: 'DB Schenker', category: 'Sustainability',
    excerpt: 'DB Schenker now offers 100% carbon-neutral air freight globally using Sustainable Aviation Fuel. Discover how SAF works and what it means for your supply chain footprint.',
    delay: '100ms',
  },
  {
    id: 8,
    title: 'Global Supply Chain Resilience: Lessons from 2024 into 2025',
    img: '/assets/img/projects/container-logistics.jpg',
    day: '18', month: 'Jan', year: '2025',
    author: 'DB Schenker', category: 'Supply Chain',
    excerpt: 'Disruptions, demand shifts, and digital transformation defined 2024. Here\'s how the industry is building resilience for the year ahead.',
    delay: '300ms',
  },
]

const filteredPosts = computed(() => {
  let list = activeCategory.value === 'All'
    ? posts
    : posts.filter(p => p.category === activeCategory.value)
  if (search.value.trim()) {
    const q = search.value.toLowerCase()
    list = list.filter(p => p.title.toLowerCase().includes(q) || p.excerpt.toLowerCase().includes(q))
  }
  return list
})

const categoryCounts = computed(() =>
  blogCats
    .filter(c => c !== 'All')
    .map(c => ({ name: c, count: posts.filter(p => p.category === c).length }))
    .filter(c => c.count > 0)
)

const featuredSidebar = posts.slice(0, 4)
const tags = ['air freight', 'ocean freight', 'sustainability', 'supply chain', 'innovation', 'customs', 'e-commerce', 'last mile']
</script>

<style scoped>
.blog-cats { display: flex; flex-wrap: wrap; gap: 8px; }
.blog-cat-btn {
  padding: 7px 16px;
  border: 2px solid #e2e2e2;
  background: #fff;
  border-radius: 20px;
  font-size: .82rem;
  font-weight: 600;
  color: #555;
  cursor: pointer;
  transition: all .2s;
}
.blog-cat-btn:hover,
.blog-cat-btn.active {
  background: #e31e24;
  border-color: #e31e24;
  color: #fff;
}

.newsletter-widget p { font-size: .88rem; color: #555; margin-bottom: 14px; }
</style>
