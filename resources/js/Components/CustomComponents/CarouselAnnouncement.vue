<template>
    <div v-if="(images.length > 1)">
        <div id="carouselExampleControls" class="carousel slide my-2" data-bs-ride="carousel">
            <div v-for="(image, index) in images" class="carousel-inner">
                <div class="carousel-item" :class="{ 'active': (index == 0) }">
                    <img :src="('/storage/' + image.path)" class="img-fluid" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
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
    height: 400px;
    width: 600px;
}
</style>