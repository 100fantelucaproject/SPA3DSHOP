<template>
    <div class="container-fluid bg-light text-center text-uppercase fw-bold py-3">
        <div class="container">
            <div class="row d-flex align-content-center mx-2">
                <div v-for="category in categories" class="col-12 col-md-4 col-lg-3 p-2 d-flex justify-content-center">
                    <div class="rounded-2 h-100 shadow-md">
                        <Link :href="route('announcement.index', { category: category.id })"
                            class="text-decoration-none text-light img-container">
                        <div class="bg-img rounded-2 btn btn-warning p-0 h-100">
                            <img src="../../css/Media/animal.jpg" class="img-fluid border-0 rounded-2 h-100"
                                alt="Image auto">
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
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link
    },
    data() {
        return {
            path:`/resources/css/Media/animal.jpg`,
            image:[
                {
                    name:'Fantasy',
                    image: '../../css/Media/',
                },
                {
                    name:'Animals',
                    image: '../../css/Media/animal.jpg',
                },
                {
                    name:'Characters',
                    image: '../../css/Media/',
                },
                {
                    name:'Vehicles',
                    image: '../../css/Media/',
                },
                {
                    name:'Architecture',
                    image: '../../css/Media/',
                },
                {
                    name:'Forniture',
                    image: '../../css/Media/',
                },
                {
                    name:'Culture',
                    image: '../../css/Media/Forniture.jpg',
                },
                {
                    name:'Art',
                    image: '../../css/Media/',
                },
                {
                    name:'Music',
                    image: '../../css/Media/',
                },
                {
                    name:'Science',
                    image: '../../css/Media/',
                },
                {
                    name:'Weapons',
                    image: '../../css/Media/',
                },
                {
                    name:'Sport',
                    image: '../../css/Media/',
                },
            ],
        }
    },
    setup() {
        const categories = computed(() => usePage().props.value.categories);

        return { categories }
    }
}

</script>

<style scoped>
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