<template>
    <AppLayout title="Show announcement">
        <div class="container-fluid my-4">
            <div class="row d-flex justify-content-center">
                <div class="col-0 col-lg-2"></div>
                <div class="col-12">
                    <div class="container shadow-lg rounded-2 bg-light py-5 ">
                        <div class="d-flex justify-content-center">
                            <div class="col-10">
                                <div>
                                    <CarouselAnnouncement :images="images" />
                                </div>
                                <h1 class="m-0 text-center text-uppercase fw-bold py-2">
                                    {{ announcement.title }}
                                </h1>
                                <hr class="my-1">
                                <div class="text-start py-2">
                                    <h3 class="card-text">{{ category }}</h3>
                                </div>
                                <hr class="my-1">
                                <div class="py-2 text-start">
                                    <p class="card-text">{{ announcement.description }}</p>
                                </div>
                                <hr class="my-1">
                                <div class="col-12 p-1 text-center text-md-start">
                                    <h5> Prezzo: {{ announcement.price }} € </h5>
                                </div>
                                <div class="col-12 p-1 text-center text-md-start">
                                    <h5> Data: {{ announcement.created_at.slice(0, 7) }}</h5>
                                </div>
                                <div class="text-center py-2">
                                    <button class="btn btn-primary shadow mx-2" data-bs-toggle="modal"
                                        data-bs-target="#Modal" @click="View3D">View 3D model</button>
                                    <a :href="route('file.download', file_id)" class="btn btn-secondary shadow mx-2">
                                        Download file</a>
                                </div>
                                <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn-close p-2" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-3 modal-background rounded-bottom">
                                                <model-viewer id="model-viewer" :src="path" camera-controls
                                                    touch-action="pan-y" auto-rotate ar alt="3D model"
                                                    class="rounded-2 shadow-lg">
                                                </model-viewer>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-0 col-lg-2"></div>
            </div>
        </div>
    </AppLayout>
</template>

<script>

import AppLayout from '../../Layouts/AppLayout.vue';
import CarouselAnnouncement from '../../Components/CustomComponents/CarouselAnnouncement.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        CarouselAnnouncement,
        AppLayout,
        Link,
    },
    props: {
        announcement: Object,
        pathFile: Object,
        images: Object,
        file_id: Number,
    },
    data() {
        return {
            category: '',
            path: '/storage/' + this.pathFile.path,
            visualize3d: false,
        };
    },
    setup() {
        const categories = computed(() => usePage().props.value.categories);
        
        return { categories };

    },
    mounted() {
        this.categories.forEach((category) => {
            if (category.id == this.announcement.category_id) {
                this.category = category.name;
                return true;
            }
        });
    },
    methods: {
        View3D() {
            this.visualize3d = !this.visualize3d;
        }
    }

}

</script>

<style scoped>

model-viewer {
    width: 100%;
    height: 500px;
    margin: 0 auto;
}

#model-viewer {
    background-image: url('../../../Media/background3d.webp');
    background-repeat: no-repeat;
    background-position: center;
    background-repeat: no-repeat;
}

.modal-background {
    background-color: black;
}
</style>