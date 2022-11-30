<template>
  <AppLayout title="Welcome">
    <WelcomeImage />
    <MainCategory />
  </AppLayout>

</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from '../Layouts/AppLayout.vue';
import MainCategory from '../Layouts/MainCategory.vue';
import WelcomeImage from '../Layouts/WelcomeImage.vue';

export default {
  components: {
    Head,
    AppLayout,
    MainCategory,
    WelcomeImage,
  }
}
</script>
