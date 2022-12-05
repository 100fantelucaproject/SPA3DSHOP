<template>
    <div class="card shadow-lg bg-body rounded-2 my-2 border border-secondary">
        <Link class="p-0 m-0 text-decoration-none text-dark" :href="route('announcement.show', announcement)">
        <img :src="'/storage/' + images[0]['path']" class="card-img-top" alt="image card">
        <div class="card-body p-0">
            <hr class="my-0">
            <div class="row d-flex justify-content-around m-0 p-0 py-2">
                <div class="col-9 d-flex align-items-center">
                    <h6 class="fs-6 fw-bold card-title text-start m-0 px-1">{{ announcement.title.substring(0, 18) + '...' }}</h6>
                </div>
                <div class="col-3 text-start px-2 d-flex align-items-center  justify-content-end">
                    <p class="m-0 fw-bold">{{ announcement.price }} €</p>
                </div>
            </div>
        </div>
        </Link>
        <div v-if="route().current('user.announcements')">
            <div class="row d-flex justify-content-around pb-1">
                <div class="col-6 text-center px-4">
                    <button @click="destroy(announcement.id)"
                        class="btn btn-danger px-2 rounded rounded-3 w-100">Delete</button>
                </div>
                <div class="col-6 text-center px-4">
                    <Link class="px-2 btn btn-success rounded rounded-3 w-100"
                        :href="route('announcement.edit', announcement.id)"> Edit
                    </Link>
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
        images: Object,
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
