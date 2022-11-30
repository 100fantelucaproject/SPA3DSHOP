<template>
    <div class="container-fluid bg-warning text-center text-uppercase fw-bold py-3">
        <div class="container">
            <div class="row d-flex justify-content-center align-content-center mx-2">
                <div class="col-12 col-md-4 col-lg-3 p-1 d-flex justify-content-center">
                    <div class="rounded-4 h-100 py-1">
                        <Link :href="route('announcement.index', { category: 4})"
                        class="text-decoration-none text-light img-container">
                        <div class="bg-img rounded-4 btn btn-warning p-0 h-100">
                            <img src="../../css/Media/Auto.jpeg" class="img-fluid border-0 rounded-4 h-100"
                                alt="Image auto">
                        </div>
                        </Link>
                        <h4 class="category-name m-0">Auto</h4>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 p-1 d-flex justify-content-center">
                    <div class="rounded-4 h-100 py-1">
                        <Link :href="route('announcement.index', { category: 3})"
                        class="text-decoration-none text-light img-container ">
                        <div class="bg-img rounded-4 btn btn-warning p-0 h-100">
                            <img src="../../css/Media/Character.jpg" class="img-fluid border-0 rounded-4 h-100"
                                alt="Image auto">
                        </div>
                        </Link>
                        <h4 class="category-name m-0">Personaggi</h4>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-6 p-1 d-flex justify-content-center">
                    <div class="rounded-4 h-100 py-1">
                        <Link :href="route('announcement.index', { category: 1})"
                        class="text-decoration-none text-light img-container ">
                        <div class="bg-img rounded-4 btn btn-warning p-0 h-100">
                            <img src="../../css/Media/Fantasy.png" class="img-fluid border-0 rounded-4 h-100"
                                alt="Image auto">
                        </div>
                        </Link>
                        <h4 class="category-name m-0">Fantasy</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row d-flex justify-content-center align-content-center mx-2">
                <div class="col-12 col-md-4 col-lg-6 p-1 d-flex justify-content-center">
                    <div class="rounded-4 h-100 py-1">
                        <Link :href="route('announcement.index', { category: 5})"
                         class="text-decoration-none text-light img-container ">
                        <div class="bg-img rounded-4 btn btn-warning p-0 h-100">
                            <img src="../../css/Media/Architecture.jpg" class="img-fluid border-0 rounded-4 h-100"
                                alt="Image auto">
                        </div>
                        </Link>
                        <h4 class="category-name m-0">Architettura</h4>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 p-1 d-flex justify-content-center">
                    <div class="rounded-4 h-100 py-1">
                        <Link :href="route('announcement.index', { category: 6})"
                         class="text-decoration-none text-light img-container ">
                        <div class="bg-img rounded-4 btn btn-warning p-0 h-100">
                            <img src="../../css/Media/Forniture.jpg" class="img-fluid border-0 rounded-4 h-100"
                                alt="Image auto">
                        </div>
                        </Link>
                        <h4 class="category-name m-0">Mobili</h4>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 p-1 d-flex justify-content-center">
                    <div class="rounded-4 h-100 py-1">
                        <Link :href="route('announcement.index', { category: 2})" 
                        class="text-decoration-none text-light img-container">
                        <div class="bg-img rounded-4 btn btn-warning p-0 h-100">
                            <img src="../../css/Media/Cat.jpg" class="img-fluid border-0 rounded-4 h-100"
                                alt="Image auto">
                        </div>
                        </Link>
                        <h4 class="category-name m-0">Animali</h4>
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
    data() {
        return {
            category: '',
        }
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
    border-color: black;
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