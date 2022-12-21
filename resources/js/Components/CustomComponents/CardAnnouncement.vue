<template>
    <div class="card shadow-lg bg-body rounded-2 my-2">
        <Link class="p-0 m-0 text-decoration-none text-dark" :href="route('announcement.show', announcement)">
        <img :src="'/storage/' + images" class="card-img-top" alt="card's image">
        <div class="card-body p-0">
            <hr class="my-0">
            <div class="row d-flex justify-content-around m-0 p-0 py-2">
                <div class="col-9 d-flex align-items-center">
                    <h6 class="fs-6 fw-bold card-title text-start m-0 px-1">{{ 
                    announcement.title.substring(0, 18) + '...'
                    }}</h6>
                </div>
                <div class="col-3 text-start px-2 d-flex align-items-center  justify-content-end">
                    <p class="m-0 fw-bold">{{ announcement.price }} €</p>
                </div>
            </div>
        </div>
        </Link>
        <div v-if="route().current('user.announcements')">
            <div class="row d-flex justify-content-center mb-2">
                <div
                    class="col-12 col-lg-6 text-md-end d-flex align-items-center align-content-center justify-content-center p-2">
                    <p class="fs-small m-0">{{ $t("common.options") }} :</p>
                </div>
                <div class="col-12 col-lg-6 text-center">
                    <div class="row d-flex justify-content-center">
                        <div class="col-1"></div>
                        <div class="col-5 text-center px-3">
                            <button @click="destroy(announcement.id)" class="btn btn-danger rounded rounded-3 w-100"><i
                                    class="fa-solid fa-trash-can"></i></button>
                        </div>
                        <div class="col-5 text-center px-3">
                            <Link class="btn btn-update rounded rounded-3 w-100"
                                :href="route('announcement.edit', announcement.id)"><i
                                class="fa-solid fa-pen-to-square"></i>
                            </Link>
                        </div>
                        <div class="col-1"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

export default {
    components: {
        Link,
    },
    props: {
        announcement: Object,
        images: String,
    },
    setup() {
        //Delete post
        const destroy = (id) => {
            if (confirm('Ne sei sicuro?')) {
                Inertia.delete(route('announcement.destroy', id));
            }
        }

        return { destroy }
    },

}
</script>

<style scoped>
.btn-update {
    background-color: #FAFF00;
}
</style>
