<template>
  <AppLayout title="Privacy and policy">
    <div class="row justify-content-center pt-4">
      <div class="col-6">
        <div>
          <jet-authentication-card-logo />
        </div>

        <div class="card shadow-sm">
          <div v-html="policy" class="card-body">
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script>
import { defineComponent } from "vue"
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import AppLayout from "../Layouts/AppLayout.vue"

export default defineComponent({
  props: ['policy'],

  components: {
    AppLayout,
    Head,
    JetAuthenticationCardLogo,
  },
})
</script>
