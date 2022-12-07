<template>
  <App-layout title="Dashboard">

  </App-layout>
</template>

<script>
import { defineComponent } from "vue"
import AppLayout from "../Layouts/AppLayout.vue";
import Welcome from "@/Jetstream/Welcome.vue";
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import Navbar from '../Layouts/Navbar.vue';

export default defineComponent({
  setup() {
        const user = computed(() => usePage().props.value.auth.user);
        return { user };
    },
  components: {
    AppLayout,
    Welcome,
    Navbar,
  }
});
</script>
