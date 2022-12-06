<template>
  <AppLayout title="Welcome">
    <div class="text-center mt-4 mb-3">
      <h1 class="fw-bold fs-1 text-uppercase"> Benvenuto</h1>
      <h3 class="fs-3">Cosa stavi cercando di preciso?</h3>
    </div>
    <MainCategory :categories="categories"/>
  </AppLayout>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';
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
  setup(){
        const categories = computed(() => usePage().props.value.categories);

        return { categories };
  }

}
</script>
