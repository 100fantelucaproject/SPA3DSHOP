<template>
    <div class="card shadow-lg bg-body rounded-4 my-4">
        <div class="card-body p-2">
            <div class="py-1">
                <h6 class="fs-6 fw-bold card-title text-center">{{ announcement.title }}</h6>
            </div>
            <div class="py-1 d-flex justify-content-center">
                <img src="../../../css/Media/Smile_bentornato.jpeg" class="img-fluid rounded-2 " alt="image card">
            </div>
            <hr class="my-1">
            <div class="text-center fst-italic">
                <p class="card-text">{{ announcement.category }}</p>
            </div>
            <hr class="my-1">
            <div class="py-1 text-center">
                <p class="card-text">{{ announcement.description }}</p>
            </div>
            <div class="row d-flex justify-content-around p-2">
                <div class="col-12 col-md-6 p-1 text-center">
                    Data: {{ announcement.date }}
                </div>
                <div class="col-12 col-md-6 p-1 text-center">
                    Prezzo: {{ announcement.price }} €
                </div>
            </div>
            <Link class="px-2" :href="route('announcement.show', announcement.id)"> View
            </Link>
            <button @click="destroy(announcement.id)" class="btn btn-danger px-2">Delete</button>
            <Link class="px-2" :href="route('announcement.edit', announcement.id)"> Edit
            </Link>
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
    },
    setup() {
        //Delete post
        const destroy = (id) => {
            if (confirm('Ne sei sicuro?')) {
                Inertia.delete(route('announcement.destroy', id));
            }
        }

        return { destroy }
    }
}
</script>