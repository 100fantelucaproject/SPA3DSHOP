<template>
    <AppLayout title="Announcements">
        <div class="container-fluid p-0 border-top border-dark">
            <div class="container-fluid shadow-bottom">
                <div v-if="(sizeScreen >= screenBreakPoint)"
                    class="row justify-content-start align-items-center py-2 border-1 border-dark border-bottom shadow-bottom">
                    <div class="col-3 ">
                        <div class="row d-flex justify-content-start align-items-center text-center">
                            <div class="btn-group">
                                <a class="nav-link fw-bold text-uppercase dropdown-toggle" type="a"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $t("common.priceRange") }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-start rounded-2 p-1">
                                    <li>
                                        <label for="exampleFormControlInput1" class="form-label pt-2 m-0">Min:
                                            {{ researchData.rangePrice.priceMin }}</label>
                                        <input type="number" class="form-control" placeholder="Prezzo min"
                                            v-model="Min">
                                    </li>
                                    <li>
                                        <label for="exampleFormControlInput1" class="form-label pt-2 m-0">Max:
                                            <span v-if="researchData.rangePrice.priceMax != 1000000000">
                                                {{ researchData.rangePrice.priceMax }}
                                            </span>
                                        </label>
                                        <input type="number" class="form-control" placeholder="Prezzo max"
                                            v-model="Max">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 px-1">
                        <div class="btn-group">
                            <a class="nav-link dropdown-toggle text-uppercase fw-bold" type="a"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $t("common.sortDate") }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-start rounded-2 p-0">
                                <li>
                                    <button class="btn btn-light rounded-0 rounded-top w-100
                                    text-uppercase" @click="changeOrder('created_at', 'asc')">
                                        {{ $t("common.older") }}
                                    </button>
                                </li>
                                <hr class="m-0">
                                <li>
                                    <button class="btn btn-light rounded-0 rounded-bottom w-100
                                    text-uppercase" @click="changeOrder('created_at', 'desc')">
                                        {{ $t("common.younger") }}
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-3 px-1">
                        <div class="btn-group">
                            <a class="nav-link fw-bold text-uppercase dropdown-toggle" type="a"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $t("common.sortPrice") }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-start rounded-2 p-0">
                                <li>
                                    <button class="btn btn-light rounded-0 rounded-top w-100 p-1
                                    text-uppercase" @click="changeOrder('price', 'desc')">
                                        {{ $t("common.expensive") }}
                                    </button>
                                </li>
                                <hr class="m-0">
                                <li>
                                    <button class="btn btn-light rounded-0 rounded-bottom w-100 p-1
                                    text-uppercase" @click="changeOrder('price', 'asc')">
                                        {{ $t("common.cheapiest") }}
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-3">
                        <select class="form-select nav-link text-uppercase fw-bold p-1"
                            aria-label="Default select example" v-model="selectedCategory">
                            <option value="" selected>{{ $t("common.allCategories") }}</option>
                            <option v-for="category in categories" :value="category.id">
                                {{ category.name }}</option>
                        </select>
                    </div>
                </div>
                <div v-else-if="(sizeScreen < screenBreakPoint)"
                    class="row justify-content-around align-items-center py-2 border-1 border-dark border-bottom shadow-bottom">
                    <div class="row d-flex justify-content-start align-items-center text-center py-1">
                        <div class="col-4 text-uppercase fw-bold">{{ $t("common.price") }}:</div>
                        <div class="col-4">
                            <input type="number" class="form-control" placeholder="Min" v-model="Min">
                        </div>
                        <div class="col-4">
                            <input type="number" class="form-control" placeholder="Max" v-model="Max">
                        </div>
                    </div>
                    <div class="col-6 px-1 text-center">
                        <div class="btn-group">
                            <a class="nav-link dropdown-toggle text-uppercase fw-bold" type="a"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $t("common.date") }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end rounded-2 p-0">
                                <li>
                                    <button class="btn btn-light rounded-0 rounded-top w-100
                                    text-uppercase" @click="changeOrder('created_at', 'asc')">
                                        {{ $t("common.older") }}
                                    </button>
                                </li>
                                <hr class="m-0">
                                <li>
                                    <button class="btn btn-light rounded-0 rounded-bottom w-100
                                    text-uppercase" @click="changeOrder('created_at', 'desc')">
                                        {{ $t("common.younger") }}
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6 px-1 text-center">
                        <div class="btn-group">
                            <a class="nav-link fw-bold text-uppercase dropdown-toggle" type="a"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $t("common.price") }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-center rounded-2 p-0">
                                <li>
                                    <button class="btn btn-light rounded-0 rounded-top w-100 p-1
                                    text-uppercase" @click="changeOrder('price', 'desc')">
                                        {{ $t("common.expensive") }}
                                    </button>
                                </li>
                                <hr class="m-0">
                                <li>
                                    <button class="btn btn-light rounded-0 rounded-bottom w-100 p-1
                                    text-uppercase" @click="changeOrder('price', 'asc')">
                                        {{ $t("common.cheapiest") }}
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <div class="col-12  py-4">
                        <div v-for="category in categories">
                            <div v-if="selectedCategory == category.id">
                                {{ $t("common.selectedCategory") }}: {{ category.name }}
                            </div>
                        </div>
                        <div v-if="researchData.textSearch">{{ $t("common.results") }}: {{ researchData.textSearch }}</div>
                        <div class="row">
                            <div v-for="(announcement, index) in announcements.data" :key="announcement.id"
                                class="col-12 col-md-6 col-lg-3">
                                <Card :announcement="announcement" :images="images[index]" />
                            </div>
                        </div>
                        <div class="my-4 d-flex justify-content-center">
                            <Pagination :elements="announcements" :researchData="researchData" :dataSearch="true">
                            </Pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>

import { ref, watch } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
import Card from '../../Components/CustomComponents/CardAnnouncement.vue';
import { Inertia } from '@inertiajs/inertia';
import Pagination from '../../Components/CustomComponents/Pagination.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Pagination,
        Link,
        AppLayout,
        Card,
    },
    props: {
        announcements: Object,
        researchData: Object,
        images: Object,
    },
    data() {
        return {
            name: '',
            screenBreakPoint: 992,
            sizeScreen: window.innerWidth,
        };
    },
    setup(props) {

        const searched = ref(props.researchData.textSearch);
        const Max = ref(props.researchData.rangePrice.PriceMax);
        const Min = ref(props.researchData.rangePrice.PriceMin);
        const selectedCategory = ref(props.researchData.category);

        const categories = computed(() => usePage().props.value.categories);

        //Filtering announcement

        const changeOrder = (column, order) => {
            Inertia.get(route('announcement.index',
                {
                    orderColumn: column,
                    order: order,
                    search_global: props.researchData.textSearch,
                    priceMin: props.researchData.rangePrice.priceMin,
                    priceMax: props.researchData.rangePrice.priceMax,
                    category: props.researchData.category,
                }));
        };

        watch(searched, _.debounce((current, previous) => {
            Inertia.get(route('announcement.index',
                {
                    orderColumn: props.researchData.orderColumn,
                    order: props.researchData.order,
                    search_global: current,
                    priceMin: props.researchData.rangePrice.priceMin,
                    priceMax: props.researchData.rangePrice.priceMax,
                    category: props.researchData.category,
                }));
        }, 600));

        watch(Max, _.debounce((current) => {
            Inertia.get(route('announcement.index',
                {
                    orderColumn: props.researchData.orderColumn,
                    order: props.researchData.order,
                    search_global: props.researchData.textSearch,
                    priceMin: props.researchData.rangePrice.priceMin,
                    priceMax: current,
                    category: props.researchData.category,
                }));
        }, 600));

        watch(Min, _.debounce((current) => {
            Inertia.get(route('announcement.index',
                {
                    orderColumn: props.researchData.orderColumn,
                    order: props.researchData.order,
                    search_global: props.researchData.textSearch,
                    priceMin: current,
                    priceMax: props.researchData.rangePrice.priceMax,
                    category: props.researchData.category,
                }));
        }, 600));

        watch(selectedCategory, (current) => {
            Inertia.get(route('announcement.index',
                {
                    orderColumn: props.researchData.orderColumn,
                    order: props.researchData.order,
                    search_global: props.researchData.textSearch,
                    priceMin: props.researchData.rangePrice.priceMin,
                    priceMax: props.researchData.rangePrice.priceMax,
                    category: current,
                }));
        });

        return { searched, changeOrder, Min, Max, selectedCategory, categories };
    },
    created() {
        window.addEventListener("resize", this.myEventHandler);
    },
    destroyed() {
        window.removeEventListener("resize", this.myEventHandler);
    },
    methods: {
        myEventHandler(e) {
            this.sizeScreen = window.innerWidth;
        }

    }

}
</script>

<style scoped>
.shadow-bottom {
    box-shadow: 0px 2px 16px 1px rgba(0, 0, 0, .2);
}
</style>
