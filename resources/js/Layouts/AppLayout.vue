<template>
  <div>
    <Head :title="title" />
    <Navbar />
    <!-- Page Content -->
    <div class="container-fluid p-0">
      <slot></slot>
    </div>
    <Footer />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Navbar from './Navbar.vue';
import Footer from './Footer.vue';

export default {
  components: {
    Head,
    Link,
    Navbar,
    Footer,
  },
  props: {
    title: String,
    categories: Object,
  },
}
</script>

