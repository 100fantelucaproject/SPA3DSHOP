<template>
    <div class="container-fluid bg-light text-center text-uppercase fw-bold py-3">
        <div class="container">
            <div class="row d-flex align-content-center mx-1">
                <div v-for="category in categories" :key="category.id"
                    class="col-12 col-md-4 col-lg-3 p-2 d-flex justify-content-center">
                    <div class="rounded-2 shadow-lg img-category">
                        <Link :href="route('announcement.index', { category: category.id })"
                            class="text-decoration-none text-light img-container">
                        <div class="bg-img rounded-2 btn btn-warning p-0 w-100 h-100">
                            <img :src="'/storage/' + category.path" class="img-fluid border-0 rounded-2 h-100 w-100"
                                alt="Image auto" />
                        </div>
                        </Link>
                        <h4 class="category-name m-0">{{ category.name }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link
    },
    props: {
        categories: Object,
    },
}

</script>

<style scoped>
.img-category {
    height: 250px;
    width: 300px;
}

img {
    object-fit: cover;
}

.bg-img {
    background-color: rgba(0, 0, 0, 0.8);
    border-width: 1px;
    border-color: rgb(133, 133, 133);
    border-style: solid;
}

.img-container>.bg-img:hover>img {
    object-fit: cover;
    opacity: 0.5;
}

.category-name {
    position: relative;
    bottom: 50%;
    color: rgba(0, 0, 0, 0);
    pointer-events: none;
}

.img-container:hover+.category-name {
    position: relative;
    bottom: 50%;
    color: rgba(255, 255, 255, 1);
    pointer-events: none;
}
</style>