<template>
  <jet-action-section>
    <template #title>
      {{ $t("auth.deleteAccount") }}
    </template>

    <template #description>
      {{ $t("auth.permanentlyDelete") }}
    </template>

    <template #content>
      <div>
        {{ $t("auth.deleteAccountText") }}
      </div>

      <div class="col-12 d-flex justify-content-center mt-3">
        <jet-danger-button @click="confirmUserDeletion">
          {{ $t("auth.deleteAccount") }}
        </jet-danger-button>
      </div>

      <!-- Delete Account Confirmation Modal -->
      <jet-dialog-modal id="confirmingUserDeletionModal">
        <template #title>
          {{ $t("auth.deleteAccount") }}
        </template>

        <template #content>
          {{ $t("auth.areYouSure") }}
          <div class="mt-4">
            <jet-input type="password" placeholder="Password"
                       ref="password"
                       v-model="form.password"
                       :class="{ 'is-invalid': form.errors.password }"
                       @keyup.enter="deleteUser" />

            <jet-input-error :message="form.errors.password" />
          </div>
        </template>

        <template #footer>
          <jet-secondary-button data-dismiss="modal" @click="closeModal">
            {{ $t("auth.cancel") }}
          </jet-secondary-button>

          <jet-danger-button @click="deleteUser" :class="{ 'text-white-50': form.processing }" :disabled="form.processing">
            <div v-show="form.processing" class="spinner-border spinner-border-sm" role="status">
              <span class="visually-hidden">{{ $t("auth.loading") }}...</span>
            </div>

            {{ $t("auth.deleteAccount") }}
          </jet-danger-button>
        </template>
      </jet-dialog-modal>
    </template>
  </jet-action-section>
</template>

<script>
import { defineComponent } from 'vue'
import JetActionSection from '@/Jetstream/ActionSection.vue'
import JetDialogModal from '@/Jetstream/DialogModal.vue'
import JetDangerButton from '@/Jetstream/DangerButton.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'

export default defineComponent({
  components: {
    JetActionSection,
    JetDangerButton,
    JetDialogModal,
    JetInput,
    JetInputError,
    JetSecondaryButton,
  },

  data() {
    return {
      modal: null,
      form: this.$inertia.form({
        password: '',
      })
    }
  },

  methods: {
    confirmUserDeletion() {
      this.form.password = '';

      let el = document.querySelector('#confirmingUserDeletionModal')
      this.modal = new bootstrap.Modal(el)
      this.modal.show()

      setTimeout(() => this.$refs.password.focus(), 250)
    },

    deleteUser() {
      this.form.delete(route('current-user.destroy'), {
        preserveScroll: true,
        onSuccess: () => this.closeModal(),
        onError: () => this.$refs.password.focus(),
        onFinish: () => this.form.reset(),
      })
    },

    closeModal() {
      this.form.reset()

      this.modal.hide()
    },
  },
})
</script>
