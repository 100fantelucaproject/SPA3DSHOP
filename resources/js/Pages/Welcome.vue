<template>
  <AppLayout title="Welcome">
    <div class="30-vh">
      <MainCarousel />
    </div>
    <MainCategory />
  </AppLayout>

</template>

<script>

import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from '../Layouts/AppLayout.vue';
import MainCategory from '../Layouts/MainCategory.vue';
import MainCarousel from '../Layouts/MainCarousel.vue';

export default {
  components:{
    Head,
    AppLayout,
    MainCarousel,
    MainCategory,
  }
}
</script>
