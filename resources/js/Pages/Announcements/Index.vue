<template>
    <AppLayout title="Announcements">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-4 bg-warning py-4">
                    <div class="mb-3">
                        <input v-model="searched" class="form-control me-2" type="search" placeholder="Search"
                            aria-label="Search">
                    </div>
                    <h6 class="text-center fw-bold text-uppercase">Range di prezzo</h6>
                    <div class="row d-flex justify-content-between text-center mb-3">
                        <div class="col-6">
                            <label for="exampleFormControlInput1" class="form-label">Min:
                                {{ researchData.rangePrice.priceMin }}</label>
                            <input type="number" class="form-control" placeholder="Prezzo min" v-model="Min">
                        </div>
                        <div class="col-6">
                            <label for="exampleFormControlInput1" class="form-label">Max:
                                {{ researchData.rangePrice.priceMax }}</label>
                            <input type="number" class="form-control" placeholder="Prezzo max" v-model="Max">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between text-center mb-3">
                        <div class="col-6">
                            <button class="btn btn-dark" @click="changeOrder('created_at', 'asc')">
                                Ordina dal più vecchio
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-dark" @click="changeOrder('created_at', 'desc')">
                                Ordina dal più nuovo
                            </button>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between text-center mb-3">
                        <div class="col-6">
                            <button class="btn btn-dark" @click="changeOrder('price', 'desc')">
                                Ordina dal più costoso
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-dark" @click="changeOrder('price', 'asc')">
                                Ordina dal meno costoso
                            </button>
                        </div>
                    </div>
                    <select class="form-select" aria-label="Default select example" v-model="selectedCategory">
                        <option value="" selected>Tutte le categorie</option>
                        <option v-for="category in categories" :value="category.id">
                            {{ category.name }}</option>
                    </select>
                </div>
                <div class="col-12 col-md-8 bg-success py-4">
                    <div v-if="researchData.textSearch">Risultati relativi a: {{ researchData.textSearch }}</div>
                    <div class="row justify-content-around">
                        <div v-for="announcement in announcements.data" :key="announcement.id"
                            class="col-12 col-md-6 col-lg-4">
                            <Card :announcement="announcement" />
                        </div>
                    </div>
                    <div class="my-4">
                        <Pagination :elements="announcements" :researchData="searchData"></Pagination>
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
    },
    data() {
        return {
            searchData: this.researchData,
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
}
</script>