<template>
  <div>

    <Head :title="title" />

    <Navbar />

    <!-- Page Content -->

      <slot></slot>


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
