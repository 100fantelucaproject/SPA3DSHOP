<template>
    <div class="card shadow-lg bg-body rounded-4 my-4">
        <div class="card-body p-2">
            <div class="py-1">
                <h6 class="fs-6 fw-bold card-title text-center">{{ title }}</h6>
            </div>
            <div class="py-1 d-flex justify-content-center">
                <img src="../../../css/Media/Smile_bentornato.jpeg" class="img-fluid rounded-2 " alt="image card">
            </div>
            <hr class="my-1">
            <div class="text-center fst-italic">
                <p class="card-text">Categoria</p>
            </div>
            <hr class="my-1">
            <div class="py-1 text-center">
                <p class="card-text">{{ description }}</p>
            </div>
            <div class="row d-flex justify-content-around p-2">
                <div class="col-12 col-md-6 p-1 text-center">
                    Data: {{ date }}
                </div>
                <div class="col-12 col-md-6 p-1 text-center">
                    Prezzo: {{ price }} €
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default{
    props:{
        title: String,
        description: String,
        price: Number,
        date: String,
    }
}
</script>