<template>
    <AppLayout title="Announcements">
        <div class="container-fluid p-0 border-top border-dark">
            <div class="container-fluid shadow-bottom">
                <div v-if="(sizeScreen >= screenBreakPoint)" class="row justify-content-start align-items-center py-2 ">
                    <div class="col-3 ">
                        <div class="row d-flex justify-content-start align-items-center text-center">
                            <div class="btn-group">
                                <a class="nav-link fw-bold text-uppercase dropdown-toggle" type="a"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Price range
                                </a>
                                <ul class="dropdown-menu dropdown-menu-start rounded-2 p-1">
                                    <li>
                                        <label for="exampleFormControlInput1" class="form-label">Min:
                                            {{ researchData.rangePrice.priceMin }}</label>
                                        <input type="number" class="form-control" placeholder="Prezzo min"
                                            v-model="Min">
                                    </li>

                                    <li>
                                        <label for="exampleFormControlInput1" class="form-label">Max:
                                            {{ researchData.rangePrice.priceMax }}</label>
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
                                Sort by data
                            </a>
                            <ul class="dropdown-menu dropdown-menu-start rounded-2 p-0">
                                <li>
                                    <button class="btn btn-light rounded-0 rounded-top w-100
                                    text-uppercase" @click="changeOrder('created_at', 'asc')">
                                        Older
                                    </button>
                                </li>
                                <hr class="m-0">
                                <li>
                                    <button class="btn btn-light rounded-0 rounded-bottom w-100
                                    text-uppercase" @click="changeOrder('created_at', 'desc')">
                                        Younger
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-3 px-1">
                        <div class="btn-group">
                            <a class="nav-link fw-bold text-uppercase dropdown-toggle" type="a"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Sort by price
                            </a>
                            <ul class="dropdown-menu dropdown-menu-start rounded-2 p-0">
                                <li>
                                    <button class="btn btn-light rounded-0 rounded-top w-100 p-1
                                    text-uppercase" @click="changeOrder('price', 'desc')">
                                        Most expensive
                                    </button>
                                </li>
                                <hr class="m-0">
                                <li>
                                    <button class="btn btn-light rounded-0 rounded-bottom w-100 p-1
                                    text-uppercase" @click="changeOrder('price', 'asc')">
                                        Cheapiest
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-3">
                        <select class="form-select nav-link text-uppercase fw-bold p-1"
                            aria-label="Default select example" v-model="selectedCategory">
                            <option value="" selected>All categories</option>
                            <option v-for="category in categories" :value="category.id">
                                {{ category.name }}</option>
                        </select>
                    </div>
                </div>
                <div v-else-if="(sizeScreen < screenBreakPoint)"
                    class="row justify-content-around align-items-center py-2 ">
                    <div class="row d-flex justify-content-start align-items-center text-center py-1">
                        <div class="col-4 text-uppercase fw-bold">Price:</div>
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
                                Data
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end rounded-2 p-0">
                                <li>
                                    <button class="btn btn-light rounded-0 rounded-top w-100
                                    text-uppercase" @click="changeOrder('created_at', 'asc')">
                                        Dal più vecchio
                                    </button>
                                </li>
                                <hr class="m-0">
                                <li>
                                    <button class="btn btn-light rounded-0 rounded-bottom w-100
                                    text-uppercase" @click="changeOrder('created_at', 'desc')">
                                        Dal più nuovo
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6 px-1 text-center">
                        <div class="btn-group">
                            <a class="nav-link fw-bold text-uppercase dropdown-toggle" type="a"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Prezzo
                            </a>
                            <ul class="dropdown-menu dropdown-menu-center rounded-2 p-0">
                                <li>
                                    <button class="btn btn-light rounded-0 rounded-top w-100 p-1
                                    text-uppercase" @click="changeOrder('price', 'desc')">
                                        Dal più costoso
                                    </button>
                                </li>
                                <hr class="m-0">
                                <li>
                                    <button class="btn btn-light rounded-0 rounded-bottom w-100 p-1
                                    text-uppercase" @click="changeOrder('price', 'asc')">
                                        Dal meno costoso
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
                                Selected category: {{ category.name }}
                            </div>
                        </div>
                        <div v-if="researchData.textSearch">Results for: {{ researchData.textSearch }}</div>
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
        const Max = ref(props.researchData.rangePrice.priceMax);
        const Min = ref(props.researchData.rangePrice.PriceMin);
        const selectedCategory = ref(props.researchData.category);

        const categories = computed(() => usePage().props.value.categories);

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
            this.sizeScreen =  window.innerWidth;
        }

    }

}
</script>

<style scoped>
.shadow-bottom {
    box-shadow: 2px 4px 16px 1px rgba(0, 0, 0, 1);
}
</style>