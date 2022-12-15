<template>
    <div v-if="(images.length > 1)">
        <div id="carousel-announcement" class="carousel slide" data-bs-ride="true">
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel-announcement"
                data-bs-slide="prev">
                <span class="text-dark" aria-hidden="true"><i class="fa-solid fa-angle-left fa-3x"></i></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel-announcement"
                data-bs-slide="next">
                <span class="text-dark" aria-hidden="true"><i class="fa-solid fa-angle-right fa-3x"></i></span>
                <span class="visually-hidden">Next</span>
            </button>
            <div class="carousel-indicators m-0">
                <button class="m-1" v-for="(image, index) in images" :key="index" type="button"
                    :class="{ 'active': (index === 0) }" data-bs-target="#carousel-announcement"
                    :data-bs-slide-to="index" :aria-label="'Slide ' + index"></button>
            </div>
            <div class="carousel-inner">
                <div v-for="(image, index) in images" class="carousel-item" :class="{ 'active': (index === 0) }"
                    :key="index">
                    <img :src="('/storage/' + image)" class="img-fluid rounded-2 shadow border border-2 border-dark" alt="carousel's image">
                </div>
            </div>
        </div>
    </div>
    <div v-else-if="(images.length <= 1)">
        <div v-for="(image, index) in images">
            <div>
                <img :src="('/storage/' + image)" class="d-block w-100 rounded-2 border border-2 border-dark" alt="announcement's image">
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

button {
    width: 50px;
}

.carousel-indicators>button {
    background-color: black;
    border-radius: 100%;
    width: 18px;
    height: 18px;
}

</style>