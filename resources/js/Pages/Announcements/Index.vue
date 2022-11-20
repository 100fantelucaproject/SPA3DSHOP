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
                            <label for="exampleFormControlInput1" class="form-label">Min</label>
                            <input type="email" class="form-control" 
                                placeholder="">
                        </div>
                        <div class="col-6">
                            <label for="exampleFormControlInput1" class="form-label">Max</label>
                            <input type="email" class="form-control" 
                                placeholder="">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between text-center mb-3">
                        <div class="col-6">
                            <button class="btn btn-dark" @click=" orderDate = 'asc' ">
                                Ordina dal più vecchio
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-dark" @click=" orderDate = 'desc' ">
                                Ordina dal più nuovo
                            </button>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between text-center mb-3">
                        <div class="col-6">
                            <button class="btn btn-dark" @click=" orderPrice='desc' ">
                                Ordina dal più costoso
                            </button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-dark" @click=" orderPrice='asc' ">
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
                        <Pagination :elements="announcements"></Pagination>
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


export default {

    components: {
        Pagination,
        Link,
        AppLayout,
        Card,
    },
    props: {
        announcements: Object,
    },
    setup() {

        const orderDate = ref('');
        const orderPrice = ref(''); 
        const searched = ref('');

        //Delete post
        const destroy = (id) => {
            if (confirm('Ne sei sicuro?')) {
                Inertia.delete(route('announcement.destroy', id));
            }
        }

        watch(orderDate, (current, previous) => {
            Inertia.get(route('announcement.index',
                {
                    created_at: current,
                    price: orderPrice.value,
                    search_global: searched.value,
                }));
        });

        watch(orderPrice, (current, previous) => {

            Inertia.get(route('announcement.index',
                {
                    created_at: orderDate.value,
                    price: current,
                    search_global: searched.value,
                }));
        });

        watch(searched, _.debounce((current, previous) => {

            Inertia.get(route('announcement.index',
                {
                    created_at: orderDate.value,
                    price: orderPrice.value,
                    search_global: current,
                }));
        }, 1000));

        return { destroy, orderPrice, orderDate, searched };
    },

    methods: {


    }
}
</script>