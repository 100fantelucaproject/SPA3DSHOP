<template>
  <AppLayout title="Welcome">
    <MainCategory :categories="categories"/>
  </AppLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
import AppLayout from '../Layouts/AppLayout.vue';
import MainCategory from '../Layouts/MainCategory.vue';
import WelcomeImage from '../Layouts/WelcomeImage.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

export default {
  components: {
    Head,
    AppLayout,
    MainCategory,
    WelcomeImage,
  }, 
  setup(){
        const categories = computed(() => usePage().props.value.categories);

        return { categories };
  }

}
</script>
