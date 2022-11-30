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
                                        <p class="card-text">{{ announcement.category }}</p>
                                    </div>
                                    <hr class="my-1">
                                    <div class="py-2 text-start">
                                        <p class="card-text">{{ announcement.description }}</p>
                                    </div>
                                    <div class="row d-flex justify-content-around p-2">
                                        <div class="col-12 col-md-6 p-1 text-center">
                                            Data: {{ announcement.created_at }}
                                        </div>
                                        <div class="col-12 col-md-6 p-1 text-center">
                                            Prezzo: {{ announcement.price }} €
                                        </div>
                                    </div>
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

export default {
    components: {
        CarouselAnnouncement,
        AppLayout,
    },
    props: {
        announcement: Object,
    }
}

</script>