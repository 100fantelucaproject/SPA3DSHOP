<template>
    <nav class="navbar navbar-expand-lg text-uppercase bg-warning">
        <div class="container-fluid">
            <Link :href="route('welcome')" class="navbar-brand px-2">logo</Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="container-fluid navbar-nav me-auto mb-2 mb-lg-0
             d-flex justify-content-between align-items-start align-items-center">
                    <div class="dropdown px-4">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            modelli
                        </button>
                        <ul class="dropdown-menu m-0 w-50 text-center">
                            <li>
                                <Link class="dropdown-item px-2 py-0" :href="route('announcement.index')">Tutti i
                                modelli</Link>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item px-2 py-0" href="#">Per categoria:</a>
                            </li>
                            <li v-for="category in categories">
                                <Link class="dropdown-item"
                                    :href="route('announcement.index', { category: category.id })">
                                {{ category.name }}
                                </Link>
                            </li>
                        </ul>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="input-group w-100">
                            <span class="input-group-text search-item-rounded"><i
                                    class="fa-brands fa-searchengin fa-2x"></i></span>
                            <input v-model="textSearch" type="search" class="form-control search-bar-rounded"
                                placeholder="Search" aria-label="Search" aria-describedby="search-addon"
                                @keydown.enter="search(textSearch)" />
                        </div>
                    </div>
                    <ul v-if="!logged" class="navbar-nav px-4 d-flex align-items-center">
                        <li class="nav-item p-2">
                            <button class="btn btn-warning rounded-5 text-uppercase">
                                <Link :href="route('login')" class="nav-link active p-0" aria-current="page">
                                accedi
                                </Link>
                            </button>
                        </li>
                        <li class="nav-item p-2">
                            <button class="btn btn-danger rounded-5 text-uppercase ">
                                <Link :href="route('register')" class="nav-link active p-0" aria-current="page">
                                registrati</Link>
                            </button>
                        </li>
                    </ul>
                    <div v-if="logged" class="navbar-nav px-4 d-flex align-items-center">
                        <li class="nav-item dropdown px-4">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <ul class="dropdown-menu m-0">
                                <li>
                                    <h6 class="dropdown-header small text-muted">
                                        Annunci
                                    </h6>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <Link :href="route('user.announcements')" class="dropdown-item">I tuoi
                                    annunci
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('announcement.create')" class="dropdown-item">Crea un
                                    annuncio
                                    </Link>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <h6 class="dropdown-header small text-muted">
                                        Manage Account
                                    </h6>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <Link :href="route('profile.show')" class="dropdown-item">Profilo
                                    </Link>
                                </li>
                                <li>
                                    <Link :href="route('api-tokens.index')" v-if="$page.props.jetstream.hasApiFeatures"
                                        class="dropdown-item" href="#">API Tokens</Link>
                                </li>
                                <li class="dropdown-item">
                                    <form @submit.prevent="logout">
                                        <jet-dropdown-link as="button">
                                            Log out
                                        </jet-dropdown-link>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import JetDropdownLink from '@/Jetstream/DropdownLink.vue';
import { Inertia } from '@inertiajs/inertia';

export default {
    components: {
        Head,
        Link,
        JetDropdownLink,
    },
    data() {
        return {
            textSearch: '',
        }
    },
    setup() {
        const user = computed(() => usePage().props.value.auth.user);
        const logged = computed(() => usePage().props.value.logged);
        const categories = computed(() => usePage().props.value.categories);

        return { user, logged, categories };
    },
    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        },
        search(text) {
            Inertia.get(route('announcement.index', { search_global: text }));
            this.textSearch = '';
        }
    },
}
</script>

<style scoped>
.search-bar-rounded {
    border-top-right-radius: 12px;
    border-bottom-right-radius: 12px;
}

.search-item-rounded {
    border-top-left-radius: 12px;
    border-bottom-left-radius: 12px;
}
</style>
