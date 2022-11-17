<template>
  <Head title="Welcome" />

  <div>

<Navbar></Navbar>

  </div>
</template>

<style scoped>

</style>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import Navbar from '../Layouts/Navbar.vue';
export default {
  components:{
    Head,
    Navbar,
  }
}
</script>
