<template>
  <AppLayout title="Forgot Password">

    <jet-authentication-card>


      <div class="card-body">
        <div class="mb-2">
          {{  $t("auth.forgotPasswordText") }}
        </div>

        <div v-if="status" class="alert alert-success" role="alert">
          {{ status }}
        </div>

        <jet-validation-errors class="mb-2" />

        <form @submit.prevent="submit">
          <div>
            <jet-label for="email" value="Email" />
            <jet-input id="email" type="email" v-model="form.email" required autofocus />
          </div>

          <div class="d-flex justify-content-end mt-4">
            <jet-button :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
              <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">{{  $t("auth.loading") }}...</span>
              </div>
              {{  $t("auth.emailLink") }}
            </jet-button>
          </div>
        </form>
      </div>
    </jet-authentication-card>
  </AppLayout>
</template>

<script>
import { defineComponent } from 'vue'
import { Head } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import AppLayout from '../../Layouts/AppLayout.vue';

export default defineComponent({
  components: {
    AppLayout,
    Head,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetLabel,
    JetValidationErrors
  },

  props: {
    status: String
  },

  data() {
    return {
      form: this.$inertia.form({
        email: ''
      })
    }
  },

  methods: {
    submit() {
      this.form.post(this.route('password.email'))
    }
  }
})
</script>
