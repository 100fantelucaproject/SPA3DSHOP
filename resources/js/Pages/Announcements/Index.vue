<template>
    <AppLayout title="Announcements">
        <div class="container-fluid p-0 border-top border-dark">
            <div class="container-fluid shadow-bottom">
                <div v-if="sizeScreen >= 576" class="row justify-content-start align-items-center py-2 ">
                    <div class="col-2 ">
                        <div class="row d-flex justify-content-start align-items-center text-center">
                            <div class="btn-group">
                                <a class="nav-link fw-bold text-uppercase dropdown-toggle" type="a"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Range di prezzo
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
                    <div class="col-2 px-1">
                        <div class="btn-group">
                            <a class="nav-link dropdown-toggle text-uppercase fw-bold" type="a"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Ordina per data
                            </a>
                            <ul class="dropdown-menu dropdown-menu-start rounded-2 p-0">
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
                    <div class="col-2 px-1">
                        <div class="btn-group">
                            <a class="nav-link fw-bold text-uppercase dropdown-toggle" type="a"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Ordina per prezzo
                            </a>
                            <ul class="dropdown-menu dropdown-menu-start rounded-2 p-0">
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
                    <div class="col-2">
                        <select class="form-select nav-link text-uppercase fw-bold p-1"
                            aria-label="Default select example" v-model="selectedCategory">
                            <option value="" selected>Tutte le categorie</option>
                            <option v-for="category in categories" :value="category.id">
                                {{ category.name }}</option>
                        </select>
                    </div>
                </div>
                <div v-else-if="sizeScreen < 576" class="row justify-content-around align-items-center py-2 ">
                    <div class="row d-flex justify-content-start align-items-center text-center py-1">
                        <div class="col-4 text-uppercase fw-bold">Prezzo:</div>
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
                    <div class="col-12 bg-success py-4">
                        <div v-for="category in categories">
                            <div v-if="selectedCategory == category.id">
                             Categoria selezionata: {{ category.name }}
                            </div>
                        </div>
                        <div v-if="researchData.textSearch">Risultati relativi a: {{ researchData.textSearch }}</div>
                        <div class="row">
                            <div v-for="(announcement, index) in announcements.data" :key="announcement.id"
                                class="col-12 col-md-6 col-lg-3">
                                <Card :announcement="announcement" :images="images[index].images300x200" />
                            </div>
                        </div>
                        <div class="my-4">
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
    data(){
        return{
            name:'',
        };
    },
    setup(props) {

        const searched = ref(props.researchData.textSearch);
        const Max = ref(props.researchData.rangePrice.priceMax);
        const Min = ref(props.researchData.rangePrice.PriceMin);
        const selectedCategory = ref(props.researchData.category);

        const sizeScreen = window.screen.width;

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

        return { searched, changeOrder, Min, Max, selectedCategory, categories, sizeScreen };
    },

}
</script>

<style scoped>
.shadow-bottom {
    box-shadow: 2px 4px 16px 1px rgba(0, 0, 0, 1);
}
</style>