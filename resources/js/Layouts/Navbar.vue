<template>
    <nav class="navbar navbar-expand-lg text-uppercase bg-light"
        :class="{ 'shadow-bottom': !route().current('announcement.index') }">
        <div class="container-fluid">
            <Link :href="route('welcome')" class="navbar-brand px-2 m-0"><img src="../../Media/logo.png" alt="logo"
                class="logo rounded-2 border"></Link>

            <!-- User on phone text search-->
            <div v-if="(sizeScreen < screenBreakPoint)">
                <div class="row d-flex justify-content-center">
                    <div class="input-group w-100">
                        <span class="input-group-text search-item-rounded"><i
                                class="fa-brands fa-searchengin fa-1x"></i></span>
                        <input v-model="textSearch" type="search" class="form-control search-bar-rounded"
                            placeholder="search" aria-label="Search" aria-describedby="search-addon"
                            @keydown.enter="search(textSearch)" />
                    </div>
                </div>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="container-fluid navbar-nav me-auto mb-2 mb-lg-0 px-0
             d-flex justify-content-center justify-content-lg-between  align-items-center">

                    <!-- User on Desktop category models-->
                    <div class="px-4 text-center row p-0 m-0">
                        <div class="btn-group col-6" v-if="sizeScreen >= screenBreakPoint && !route().current('announcement.index')">
                            <a class="nav-link dropdown-toggle text-dark fw-bold" type="a" data-bs-toggle="dropdown">
                                {{ $t("nav.models") }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-start m-0 w-50">
                                <li>
                                    <Link class="dropdown-item px-2 py-0" :href="route('announcement.index')">
                                        {{  $t("nav.allModels") }}
                                    </Link>
                                </li>
                                <li>
                                    <hr class="dropdown-divider mb-0">
                                </li>
                                <li v-for="category in categories">
                                    <Link class="dropdown-item"
                                        :href="route('announcement.index', { category: category.id })">
                                    {{ category.name }}
                                    </Link>
                                    <hr class="m-0 bg-dark">
                                </li>
                            </ul>
                        </div>
                        <div class="col-6"><LangSelector></LangSelector></div>
                    </div>
                    <div class="row m-0 p-0 d-flex justify-content-center">
                        <!-- User on desktop text search-->
                        <div v-if="(sizeScreen >= screenBreakPoint)" class="col-6 d-flex align-items-center"
                            :class="{ 'col-9': logged }">
                            <div class="input-group w-100">
                                <span class="input-group-text search-item-rounded"><i
                                        class="fa-brands fa-searchengin fa-2x"></i></span>
                                <input v-model="textSearch" type="search" class="form-control search-bar-rounded"
                                    placeholder="Search" aria-label="Search" aria-describedby="search-addon"
                                    @keydown.enter="search(textSearch)" />
                            </div>
                        </div>
                        <!-- User not logged in -->
                        <ul v-if="!logged" class="navbar-nav px-4 d-flex align-items-center col-12 col-md-6">
                            <li class="nav-item p-2 ">
                                <button class="btn btn-primary rounded-2 text-uppercase shadow p-0 px-1">
                                    <Link :href="route('login')" class="nav-link active p-1 fw-bold"
                                        aria-current="page">
                                    {{ $t("nav.login") }}
                                    </Link>
                                </button>
                            </li>
                            <li class="nav-item p-2">
                                <button class="btn btn-register rounded-2 text-uppercase shadow p-0 px-1">
                                    <Link :href="route('register')" class="nav-link active p-1 fw-bold"
                                        aria-current="page">
                                    {{ $t("nav.register") }}</Link>
                                </button>
                            </li>
                        </ul>

                        <!-- User logged in -->
                        <div v-if="logged"
                            class="navbar-nav px-4 d-flex align-items-center align-content-center justify-content-center justify-content-lg-end col-12 col-md-3">
                            <li class="nav-item btn-group px-4 text-center">
                                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fa-solid fa-user"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end m-0">
                                    <li class="mb-1">
                                        <h6 class="dropdown-header small fw-bold">
                                            {{ $t("common.announcement") }}
                                        </h6>
                                    </li>
                                    <li>
                                        <hr class="my-0 dropdown-divider">
                                    </li>
                                    <li>
                                        <Link :href="route('user.announcements')" class="dropdown-item">
                                            {{ $t("nav.yourAnnouncement") }}
                                        </Link>
                                    </li>
                                    <li class="mb-1">
                                        <Link :href="route('announcement.create')" class="dropdown-item">
                                            {{ $t("nav.createAnnouncement") }}
                                        </Link>
                                    </li>
                                    <li>
                                        <hr class="my-0 dropdown-divider">
                                    </li>
                                    <li>
                                        <h6 class="dropdown-header small fw-bold">
                                            {{  $t("nav.manageAccount") }}
                                        </h6>
                                    </li>
                                    <li class="mb-1">
                                        <hr class="my-0 dropdown-divider">
                                    </li>
                                    <li>
                                        <Link :href="route('profile.show')" class="dropdown-item">
                                            {{  $t("nav.profile") }}
                                        </Link>
                                    </li>
                                    <Link :href="route('logout')" method="post" as="button"
                                        class="w-100 p-0 text-start btn btn-link">
                                    <li class="dropdown-item">
                                        <i class="fa-solid fa-right-from-bracket"></i>
                                    </li>
                                    </Link>
                                </ul>
                            </li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <!-- User on phone category research -->
    <div v-if="(sizeScreen < screenBreakPoint)" class="phone-section border-top border-dark"
        :class="{ 'shadow-bottom': !route().current('announcement.index') }">
        <div class="col-12 text-center text-uppercase">
            <div class="dropdown w-100">
                <button class="btn btn-light dropdown-toggle text-dark text-uppercase fw-bold p-2 w-100" type="a"
                    data-bs-toggle="dropdown">
                    {{  $t("nav.models") }}
                </button>
                <ul class="dropdown-menu m-0 w-50 text-center w-100 fw-bold">
                    <li>
                        <Link class="dropdown-item px-2 py-0 fw-bold" :href="route('announcement.index')">
                            {{  $t("nav.allModels") }}
                        </Link>
                    </li>
                    <li>
                        <hr class="dropdown-divider bg-warning">
                    </li>
                    <li v-for="category in categories">
                        <Link class="dropdown-item fw-bold"
                            :href="route('announcement.index', { category: category.id })">
                        {{ category.name }}
                        </Link>
                        <hr class="my-1 bg-dark">
                    </li>
                </ul>
            </div>
        </div>
    </div>

</template>

<script>

import { Link } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import LangSelector from './LangSelector.vue';
export default {
    components: {
        Link,
        LangSelector,
    },
    data() {
        return {
            textSearch: '',
            screenBreakPoint: 992,
            sizeScreen: window.innerWidth,
        }
    },
    mounted() {
        window.onresize = () => {
            this.sizeScreen = window.innerWidth
        }
    },
    setup() {
        const user = computed(() => usePage().props.value.auth.user);
        const logged = computed(() => usePage().props.value.logged);
        const categories = computed(() => usePage().props.value.categories);

        //Upload page with research's result
        const search = (text) => {
            Inertia.get(route('announcement.index', { search_global: text }));
        }

        return { user, logged, categories, search };
    },
    created() {
        window.addEventListener("resize", this.windowsResize);
    },
    destroyed() {
        window.removeEventListener("resize", this.windowsResize);
    },
    methods: {
        windowsResize(e) {
            this.sizeScreen = window.innerWidth;
        }

    }
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

.logo {
    height: 40px;
    width: 40px;
}

.shadow-bottom {
    box-shadow: 0px 2px 16px 1px rgba(0, 0, 0, .2);
}

.btn-register {
    background-color: #FF7F11;
}
</style>
