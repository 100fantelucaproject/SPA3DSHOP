<template>
  <AppLayout title="Welcome Page">
    <MainCategory :categories="categories" />
  </AppLayout>
</template>

<script>

import AppLayout from '../Layouts/AppLayout.vue';
import MainCategory from '../Layouts/MainCategory.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

export default {
  components: {
    Head,
    AppLayout,
    MainCategory,
  },
  setup() {
    const categories = computed(() => usePage().props.value.categories);

    return { categories };
  }

}
</script>
