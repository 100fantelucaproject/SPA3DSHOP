<template>
    <div v-if="(images.length > 1)">
        <div id="carouselExampleControls" class="carousel slide text-center" data-bs-ride="carousel">
            <div class="carousel-inner">
                <button class="carousel-control-prev btn-carousel-prev" type="button"
                    data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="text-dark" aria-hidden="true"><i class="fa-solid fa-chevron-left fa-3x"></i></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <div v-for="(image, index) in images" class="carousel-item" :class="{ 'active': (index === 0) }">
                    <img :src="('/storage/' + image.path)" class="img-fluid rounded-2 shadow" alt="...">
                </div>
                <button class="carousel-control-next btn-carousel-next" type="button"
                    data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="text-dark" aria-hidden="true"><i class="fa-solid fa-chevron-right fa-3x"></i></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <div v-else-if="(images.length <= 1)">
        <div v-for="(image, index) in images">
            <div>
                <img :src="('/storage/' + image.path)" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>

</template>

<script>

export default {
    props: {
        images: Object,
    }
}
</script>

<style scoped>
img {
    max-height: 400px;
    width: 600px;
}

button {
    width: 50px;
}
</style>