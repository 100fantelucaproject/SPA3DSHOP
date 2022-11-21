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
                            <label for="exampleFormControlInput1" class="form-label">Min: {{ rangePrice.priceMin
                            }}</label>
                            <input type="number" class="form-control" placeholder="Prezzo min" v-model="Min" >
                        </div>
                        <div class="col-6">
                            <label for="exampleFormControlInput1" class="form-label">Max: {{ rangePrice.priceMax
                            }}</label>
                            <input type="number" class="form-control" placeholder="Prezzo max" v-model="Max" >
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
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>

                <div class="col-12 col-md-8 bg-success py-4">
                    <div v-if="textSearch">Risultati relativi a: {{ textSearch }}</div>
                    <div class="row justify-content-around">
                        <div v-for="announcement in announcements.data" :key="announcement.id"
                            class="col-12 col-md-6 col-lg-4">
                            <Card :title="announcement.title" :description="announcement.description"
                                :price="announcement.price" :date="announcement.created_at"> </Card>

                            <Link class="px-2" :href="route('announcement.show', announcement.id)"> View
                            </Link>

                            <button @click="destroy(announcement.id)" class="btn btn-danger px-2">Delete</button>

                            <Link class="px-2" :href="route('announcement.edit', announcement.id)"> Edit
                            </Link>
                        </div>
                    </div>
                    <div class="my-4">
                        <Pagination :elements="announcements" :researchData="researchData"></Pagination>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

<script>
import { toRefs, toRef, ref, watch } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
import Card from '../../Components/CustomComponents/CardAnnouncement.vue';
import { Inertia } from '@inertiajs/inertia';
import Pagination from '../../Components/CustomComponents/Pagination.vue';
import { DOMDirectiveTransforms } from '@vue/compiler-dom';


export default {
    props: {
        announcements: Object,
        textSearch: String,
        orderColumn: String,
        order: String,
        rangePrice: Object,
    },
    data() {
        return {
            researchData: {
                textSearch: this.textSearch,
                orderColumn: this.orderColumn,
                order: this.order,
                rangePrice: this.rangePrice,
            }
        };
    },
    components: {
        Pagination,
        Link,
        AppLayout,
        Card,
    },
    setup(props) {

        const searched = ref(props.textSearch);
        const Max = ref(props.rangePrice.priceMax);
        const Min = ref(props.rangePrice.PriceMin);

        //Delete post
        const destroy = (id) => {
            if (confirm('Ne sei sicuro?')) {
                Inertia.delete(route('announcement.destroy', id));
            }
        }

        const changeOrder = (column, order) => {
            Inertia.get(route('announcement.index',
                {
                    orderColumn: column,
                    order: order,
                    search_global: props.textSearch,
                    priceMin: props.rangePrice.priceMin,
                    priceMax: props.rangePrice.priceMax,
                }));
        };

        watch(searched, _.debounce((current, previous) => {
            Inertia.get(route('announcement.index',
                {
                    orderColumn: props.orderColumn,
                    order: props.order,
                    search_global: current,
                    priceMin: props.rangePrice.priceMin,
                    priceMax: props.rangePrice.priceMax,
                }));
        }, 800));

        watch(Max, _.debounce((current) => {
            Inertia.get(route('announcement.index',
                {
                    orderColumn: props.orderColumn,
                    order: props.order,
                    search_global: props.textSearch,
                    priceMin: props.rangePrice.priceMin,
                    priceMax: current,
                }));
        }, 800));

        watch(Min, _.debounce((current) => {
            Inertia.get(route('announcement.index',
                {
                    orderColumn: props.orderColumn,
                    order: props.order,
                    search_global: props.textSearch,
                    priceMin: current,
                    priceMax: props.rangePrice.priceMax,
                }));
        }, 800));

        return { destroy, searched, changeOrder, Min, Max };
    },
}
</script>