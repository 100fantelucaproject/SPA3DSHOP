<template>
    <AppLayout>
        <div class="container">
            <div class="container-fluid py-4 bg-warning">
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <h4 class="m-0 text-center text-uppercase fw-bold">
                            {{ announcement.title }}
                        </h4>
                        <div class="d-flex justify-content-center">
                            <div id="carouselExampleControls" class="carousel slide my-2" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="../../../css/Media/Smile_bentornato.jpeg" class="d-block w-100"
                                            alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../../../css/Media/Smile_bentornato.jpeg" class="d-block w-100"
                                            alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../../../css/Media/Smile_bentornato.jpeg" class="d-block w-100"
                                            alt="...">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <hr class="my-1">
                        <div class="text-center py-2">
                            <p class="card-text">Categoria</p>
                        </div>
                        <hr class="my-1">
                        <div class="py-2 text-start">
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

                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue';


export default {
    components: {
        AppLayout,
    },
    props: {
        announcement: Object,
    }
}

</script>