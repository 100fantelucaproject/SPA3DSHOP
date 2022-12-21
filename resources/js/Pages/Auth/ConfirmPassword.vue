<template>
  <AppLayout title="Confirm password">

    <jet-authentication-card>

      <div class="card-body">

        <div class="mb-2">
          {{ $t("auth.secureArea") }}
        </div>

        <jet-validation-errors class="mb-2" />

        <form @submit.prevent="submit">
          <div class="mb-3">
            <jet-label for="password" value="Password" />
            <jet-input id="password" type="password" v-model="form.password" required autocomplete="current-password"
              autofocus />
          </div>

          <div class="d-flex justify-content-end mt-2">
            <jet-button class="ms-4" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
              <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">{{ $t("auth.loading") }}...</span>
              </div>

              {{ $t("auth.confirm") }}
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

  data() {
    return {
      form: this.$inertia.form({
        password: '',
      })
    }
  },

  methods: {
    submit() {
      this.form.post(this.route('password.confirm'), {
        onFinish: () => this.form.reset(),
      })
    }
  }
})
</script>
