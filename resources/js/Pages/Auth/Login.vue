<template>
    <div class="container-fluid my-5 p-5">
        <div class="row d-flex justify-content-center align-content-center">
            <div class="col-0 col-lg-2"></div>
            <div class="col-12 col-lg-8">
                <div class="card rounded-4 border-dark border border-1 shadow-lg">
                    <div class="row m-0 p-0 justify-content-center">
                        <div class="col-12 col-lg-6 text-center welcome-view d-none d-lg-block">
                            <div class="row d-flex justify-content-center align-content-center align-items-center">
                                <div class="col-12 text-uppercase ">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6 ">
                            <div class="card-body">
                                <h5 class="card-title text-center text-uppercase fw-bold">BENTORNATO !</h5>
                                <jet-validation-errors class="mb-3" />
                                <div v-if="status" class="alert alert-success mb-3 rounded-0" role="alert">
                                    {{ status }}
                                </div>
                                <form class="mb-3" @submit.prevent="submit">
                                    <div class="mb-3">
                                        <jet-label for="email" class="form-label fw-bold">Email</jet-label>
                                        <jet-input v-model="form.email" type="email" class="form-control" id="email"
                                            required autofocus />
                                    </div>
                                    <div class="mb-3">
                                        <jet-label for="password" class="form-label fw-bold">Password</jet-label>
                                        <jet-input v-model="form.password" type="password" class="form-control"
                                            id="password" required autocomplete="current-password" />
                                    </div>
                                    <div class="mb-3 form-check">
                                        <jet-checkbox id="remember_me" name="remember"
                                            v-model:checked="form.remember" />
                                        <label class="form-check-label" for="remember_me">Ricordati di me</label>
                                    </div>
                                    <div class="text-center">
                                        <jet-button type="submit" class="btn btn-success fw-bold"
                                            :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
                                            <div v-show="form.processing" class="spinner-border spinner-border-sm"
                                                role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            Login
                                        </jet-button>
                                    </div>
                                    <div class="text-center">
                                        <Link v-if="canResetPassword" :href="route('password.request')"
                                            class="text-muted me-3">
                                        <p class="fw-small fst-italic text-center">Password dimenticata?</p>
                                        </Link>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-0 col-lg-2"></div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
  components: {
    Head,
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetCheckbox,
    JetLabel,
    JetValidationErrors,
    Link,
  },

  props: {
    canResetPassword: Boolean,
    status: String
  },

  data() {
    return {
      form: this.$inertia.form({
        email: '',
        password: '',
        remember: false
      })
    }
  },

  methods: {
    submit() {
      this.form
          .transform(data => ({
            ... data,
            remember: this.form.remember ? 'on' : ''
          }))
          .post(this.route('login'), {
            onFinish: () => this.form.reset('password'),
          })
    }
  }
})
</script>

<style scoped>
.welcome-view {
    background-color: black;
    background-image: url('../../../css/Media/Smile_bentornato.jpeg'); 
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    border-top-left-radius: 15px;
    border-bottom-left-radius: 15px;
    border-right-color: black;
    border-right-width: 1px;
    border-right-style: solid;
}
</style>
