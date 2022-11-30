<template>
    <div class="container-fluid img-welcome d-flex justify-content-center">
        <div class="row d-flex justify-content-center align-content-center w-100">
            <div class="col-12 px-3 w-75 text-light text-center">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 py-3">
                        <h2 class="fw-bold fs-2">Esplora un modo di modelli 3d</h2>
                    </div>
                    <div class="col-12 py-3">
                        <input v-model="textSearch" class="form-control me-2 rounded-5 py-2" type="search"
                            placeholder="Search" aria-label="Search" @keydown.enter="search(textSearch)">
                        <i class="fa-brands fa-searchengin fa-2x search-item"></i>
                    </div>
                    <div class="col-12 py-3">
                        <p class="fst-italic fw-bold fs-6"> L' infinito a portata di mano</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },
    data() {
        return {
            textSearch: '',
        }
    },
    methods: {
        search(text) {
            Inertia.get(route('announcement.index', { search_global: text }));
            this.textSearch = '';
        }
    }
}


</script>

<style scoped>
.img-welcome {
    background-image: url('../../css/Media/background_welcome.jpg');
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    height: 400px;
}

.search-item {
    color: black;
    position: relative;
    bottom: 48%;
    left: 46%;
}

@media screen and (max-width: 576px) {
    .search-item {
        position: relative;
        bottom: 48%;
        left: 40%;
    }
}
</style>