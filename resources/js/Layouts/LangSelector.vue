<template>
    <li class="nav-item dropdown px-1">
        <button class="nav-link dropdown-toggle btn text-uppercase fw-bold text-dark" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            {{ $t("nav.language_full") }}
        </button>
        <ul class="dropdown-menu m-0">
            <li><button class="dropdown-item" @click="setLocale('en')">English</button>
            </li>
            <li><button class="dropdown-item" @click="setLocale('it')">Italiano</button>
            </li>
        </ul>
    </li>
</template>

<script>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

export default {
    setup() {
        return {
            responsiveSettingsLanguage: ref(false)
        }
    },
    methods: {
        setLocale(locale) {
            this.responsiveSettingsLanguage = true;
            Inertia.post(route('locale'), {
                'language': locale,
            });
            this.$i18n.locale = locale;
            this.responsiveSettingsLanguage = false;
        }
    }
}
</script>