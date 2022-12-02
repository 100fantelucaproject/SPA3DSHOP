<template>
    <AppLayout>
        <div class="container">
            <div class="container-fluid py-4 bg-warning">
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <div class="container">
                            <div class="d-flex justify-content-center">
                                <div class="col-1"></div>
                                <div class="col-10">
                                    <h4 class="m-0 text-center text-uppercase fw-bold">
                                        {{ announcement.title }}
                                    </h4>
                                    <div class="d-flex justify-content-center">
                                        <CarouselAnnouncement />
                                    </div>
                                    <hr class="my-1">
                                    <div class="text-center py-2">
                                        <p class="card-text">{{ category }}</p>
                                    </div>
                                    <hr class="my-1">
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
                                    <model-viewer :src="path" camera-controls auto-rotate loading="lazy"> </model-viewer>
                                </div>
                                
                                <div class="col-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
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
        };
    },
    components: {
        CarouselAnnouncement,
        AppLayout,
    },
    props: {
        announcement: Object,
        pathFile: Object,
    },
    setup(props) {
        const categories = computed(() => usePage().props.value.categories);
        console.log(props.pathFile);
        return { categories };
    },
    mounted() {
        this.categories.forEach((category) => {
            if (category.id == this.announcement.category_id) {
                this.category = category.name;
                return true;
            }
        });
    }

}

</script>

<style>
model-viewer{
    width:400px;
    height: 500px;
    margin: 0 auto;
}

</style>