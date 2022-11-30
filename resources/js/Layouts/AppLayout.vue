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
  props: {
    title: String,
  },

  components: {
    Head,
    Link,
    Navbar,
    Footer,
  },
}
</script>
