<template>
    <AppLayout title="Login">
        <div class="container-fluid my-5 p-5">
            <div class="row d-flex justify-content-center align-content-center">
                <div class="col-0 col-lg-2"></div>
                <div class="col-12 col-lg-8">
                    <div class="card rounded-4 border-dark border border-1 shadow-lg">
                        <div class="row m-0 p-0 justify-content-center">
                            <div class="col-12 col-lg-6 text-center welcome-view d-none d-lg-block">
                                <div class="row d-flex justify-content-center align-content-center align-items-center">
                                    <div class="col-12 text-uppercase">

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 ">
                                <div class="card-body">
                                    <h5 class="card-title text-center text-uppercase fw-bold">{{ $t("auth.welcome") }} !</h5>
                                    <jet-validation-errors class="mb-3" />
                                    <form class="mb-3" @submit.prevent="submit">
                                        <div class="mb-3">
                                            <jet-label for="name" class="form-label fw-bold">{{ $t("auth.name") }}</jet-label>
                                            <jet-input v-model="form.name" type="text" class="form-control" id="name"
                                                required autofocus autocomplete="name" />
                                        </div>
                                        <div class="mb-3">
                                            <jet-label for="email" class="form-label fw-bold">{{ $t("auth.email") }}</jet-label>
                                            <jet-input v-model="form.email" type="email" class="form-control" id="email"
                                                required />
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label fw-bold">{{ $t("auth.password") }}</label>
                                            <input v-model="form.password" type="password" class="form-control"
                                                id="password" required autocomplete="new-password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label fw-bold">
                                                {{ $t("auth.confirmPassword") }}
                                            </label>
                                            <input v-model="form.password_confirmation" type="password"
                                                class="form-control" id="password_confirmation" required
                                                autocomplete="new-password">
                                        </div>
                                        <div class="mb-3 form-check">
                                            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                                                <div class="custom-control custom-checkbox">
                                                    <jet-checkbox name="terms" id="terms"
                                                        v-model:checked="form.terms" />
                                                    <label class="form-check-label" for="policy_accepted">{{ $t("auth.iAccept") }}
                                                        <a target="_blank" :href="route('terms.show')">Terms of
                                                            Service</a>
                                                        {{ $t("auth.e") }} <a target="_blank" :href="route('policy.show')">Privacy
                                                            Policy</a></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <div class="mb-3">
                                                <jet-button class="btn-primary shadow" :class="{ 'text-light': form.processing }"
                                                    :disabled="form.processing">
                                                    {{ $t("auth.register") }}
                                                    <div v-show="form.processing"
                                                        class="spinner-border spinner-border-sm" role="status">
                                                        <span class="visually-hidden">{{ $t("auth.loading") }}...</span>
                                                    </div>
                                                </jet-button>

                                            </div>
                                            <div>
                                                <Link :href="route('login')" class="text-muted  text-decoration-none">
                                                    {{ $t("auth.alreadyRegistered") }}
                                                </Link>
                                            </div>
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
    </AppLayout>
</template>
 
<script>
import { defineComponent } from 'vue'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from '../../Layouts/AppLayout.vue';

export default defineComponent({
    components: {
        AppLayout,
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

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                terms: false,
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
})
</script>
 
<style scoped>
.welcome-view {
    background-color: black;
    background-image: url('../../../Media/background.jpg');
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