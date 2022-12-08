<template>
    <AppLayout>
        <div class="container-fluid py-2 my-3">
            <div class="row d-flex justify-content-center">
                <div class="col-0 col-lg-2"></div>
                <div class="col-12">
                    <div class="container rounded-2 shadow-lg border bg-warning py-2">
                        <div class="d-flex justify-content-center">
                            <div class="col-10">
                                <h1 class="m-0 text-center text-uppercase fw-bold py-2">
                                    {{ announcement.title }}
                                </h1>
                                <div>
                                    <CarouselAnnouncement :images="images" />
                                </div>
                                <div class="text-center py-2">
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        @click="View3D">Visualizza 3D</button>
                                </div>
                                <div class="text-center py-2">
                                    <p class="card-text">{{ category }}</p>
                                </div>
                                <div class="py-2 text-start">
                                    <p class="card-text">{{ announcement.description }}</p>
                                </div>
                                <div class="row d-flex justify-content-around p-2">
                                    <div class="col-12 col-md-6 p-1 text-center">
                                        Data: {{ announcement.created_at.slice(0, 7) }}
                                    </div>
                                    <div class="col-12 col-md-6 p-1 text-center">
                                        Prezzo: {{ announcement.price }} €
                                    </div>
                                </div>
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn-close p-2" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-3">
                                                <model-viewer :src="path" camera-controls auto-rotate>
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

export default {
    data() {
        return {
            category: '',
            path: '/storage/' + this.pathFile.path,
            visualize3d: false,
        };
    },
    components: {
        CarouselAnnouncement,
        AppLayout,
    },
    props: {
        announcement: Object,
        pathFile: Object,
        images: Object,
    },
    setup(props) {
        const categories = computed(() => usePage().props.value.categories);
        console.log(props.images);
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




</style>