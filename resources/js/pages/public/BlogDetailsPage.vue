<template>
  <PublicLayout>
    <section class="page-header post-details">
      <div class="container">
        <div class="page-header-info">
          <h4>Blog</h4>
          <h2>Mastering Efficiency in<br><span>Supply Chains!</span></h2>
          <p>Explore key trends and innovations shaping the future of global transportation logistics.</p>
        </div>
      </div>
    </section>

    <section class="blog-section blog-page padding">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 sm-padding">
            <div class="blog-details-wrap row-gap">
              <div class="post-thumb mb-30">
                <img src="/assets/img/content-bg-1.jpg" alt="post">
              </div>
              <ul class="post-meta mb-20">
                <li><i class="fa-regular fa-user"></i><a href="#">Elliot Alderson</a></li>
                <li><i class="fa-sharp fa-regular fa-bookmark"></i><a href="#">Logistics</a></li>
                <li><i class="fa-regular fa-calendar"></i><a href="#">Jan 10, 2025</a></li>
              </ul>
              <h2>Mastering Efficiency in Global Supply Chains</h2>
              <p>Modern logistics companies are revolutionizing the way goods move around the world. From real-time tracking systems to AI-powered route optimization, technology is at the heart of today's most efficient supply chains.</p>
              <p>DB Schenker's integrated logistics platform enables businesses to gain full visibility into their shipments, reduce costs, and respond faster to market demands. Our global network spans 130+ countries, giving clients access to world-class transportation infrastructure.</p>
              <blockquote>
                <p>"Efficiency is not about doing more — it's about doing the right things at the right time with the right resources."</p>
              </blockquote>
              <p>As e-commerce continues to drive demand for faster deliveries, logistics providers must adapt with smarter warehousing, automated sorting systems, and last-mile delivery innovations. DB Schenker is leading this transformation with investments in green logistics and digital supply chain solutions.</p>

              <div class="post-tags-social d-flex justify-content-between align-items-center mt-40">
                <div class="post-tags">
                  <span>Tags:</span>
                  <a href="#">logistics</a>
                  <a href="#">supply chain</a>
                  <a href="#">freight</a>
                </div>
                <div class="post-social-share">
                  <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                  <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                  <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
              </div>

              <div class="comment-section mt-50">
                <h3>Leave A Comment</h3>
                <form @submit.prevent="submitComment" class="comment-form mt-30">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-field"><input type="text" v-model="comment.name" class="form-control" placeholder="Your Name" required></div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-field"><input type="email" v-model="comment.email" class="form-control" placeholder="Your Email" required></div>
                    </div>
                    <div class="col-12">
                      <div class="form-field"><textarea v-model="comment.message" rows="5" class="form-control" placeholder="Your Comment" required></textarea></div>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="default-btn">Post Comment</button>
                    </div>
                  </div>
                  <div v-if="commentMsg" class="alert alert-success mt-3">{{ commentMsg }}</div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-lg-4 sm-padding">
            <div class="sidebar-widget search-widget">
              <form @submit.prevent class="search-form">
                <input type="text" class="form-control" placeholder="Search">
                <button class="search-btn" type="button"><i class="fa-regular fa-magnifying-glass"></i></button>
              </form>
            </div>
            <div class="sidebar-widget">
              <div class="widget-title"><h3>Categories</h3></div>
              <ul class="category-list">
                <li><a href="#">Delivery</a><span>23</span></li>
                <li><a href="#">Freight</a><span>05</span></li>
                <li><a href="#">Logistics</a><span>18</span></li>
                <li><a href="#">Shipping</a><span>04</span></li>
                <li><a href="#">Transport</a><span>15</span></li>
              </ul>
            </div>
            <div class="sidebar-widget">
              <div class="widget-title"><h3>Recent Articles</h3></div>
              <ul class="thumb-post">
                <li v-for="p in recentPosts" :key="p.id">
                  <div class="thumb"><img :src="p.img" alt="thumb"></div>
                  <div class="thumb-post-info">
                    <h3><router-link to="/blog/details">{{ p.title }}</router-link></h3>
                    <a href="#" class="date">{{ p.date }}</a>
                  </div>
                </li>
              </ul>
            </div>
            <div class="sidebar-widget sidebar-banner">
              <router-link to="/contact"><img src="/assets/img/db-schenker-insights-corporate-sustainability-stage.webp" alt="banner"></router-link>
            </div>
            <div class="sidebar-widget">
              <div class="widget-title"><h3>Tags</h3></div>
              <ul class="tags">
                <li v-for="tag in tags" :key="tag"><a href="#">{{ tag }}</a></li>
              </ul>
            </div>
          </div>
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

const commentMsg = ref('')
const comment = ref({ name: '', email: '', message: '' })

function submitComment() {
  commentMsg.value = 'Your comment has been submitted and is awaiting moderation.'
  comment.value = { name: '', email: '', message: '' }
}

const recentPosts = [
  { id: 1, title: 'e-Shipping and Tracking: Digital Transparency Across the Supply Chain', img: '/assets/img/blog/eshipping.jpg', date: 'May 27 2025' },
  { id: 2, title: 'The Magic Mix for Freight: Why the Best Solution Isn\'t Always Black and White', img: '/assets/img/blog/magic-mix-freight.jpg', date: 'May 5 2025' },
  { id: 3, title: 'Port Operations: Managing Container Terminals at Scale', img: '/assets/img/projects/port-terminal.jpg', date: 'Apr 15 2025' },
  { id: 4, title: 'Fleet Management: Optimizing Road Freight Across Borders', img: '/assets/img/projects/fleet-operations.jpg', date: 'Mar 22 2025' },
]

const tags = ['business', 'marketing', 'logistics', 'shipping', 'freight', 'supply chain', 'transport', 'warehousing']
</script>
