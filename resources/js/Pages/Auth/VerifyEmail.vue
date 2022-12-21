<template>
  <AppLayout>

    <jet-authentication-card>

      <div class="card-body">
        <div class="mb-3 small text-muted">
          {{ $t("auth.emailVerificationText") }}
        </div>

        <div class="alert alert-success" role="alert" v-if="verificationLinkSent">
          {{ $t("auth.emailVerificationSent") }}
        </div>

        <form @submit.prevent="submit">
          <div class="mt-4 d-flex justify-content-between">
            <jet-button :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
              <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">{{ $t("auth.loading") }}...</span>
              </div>

              {{ $t("auth.resendEmail") }}
            </jet-button>

            <Link :href="route('logout')" method="post" as="button" class="btn btn-link">{{ $t("auth.logout") }}</Link>
          </div>
        </form>
      </div>
    </jet-authentication-card>
  </AppLayout>
</template>

<script>
import { defineComponent } from "vue";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue"
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue"
import JetButton from "@/Jetstream/Button.vue"
import { Head, Link } from "@inertiajs/inertia-vue3"
import AppLayout from "../../Layouts/AppLayout.vue";

export default defineComponent({
  components: {
    AppLayout,
    Head,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    Link
  },

  props: {
    status: String
  },

  data() {
    return {
      form: this.$inertia.form()
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("verification.send"));
    }
  },

  computed: {
    verificationLinkSent() {
      return this.status === "verification-link-sent";
    }
  }
})
</script>
