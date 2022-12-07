<template>
    <form class="mb-3" @submit.prevent="submitImage">
        <div class="mb-3">
            <label for="file" class="fw-bold fs-5">Vuoi caricare delle nuove immagini?</label>
            <input type="file" id="inputImage" class="form-control" multiple @change="previewImage" ref="images" />
        </div>
        <div v-if="urls.length > 0">
            <h2 class="col-12 text-center">Immagini nuove</h2>
            <div class="container border border-dark rounded-2 shadow my-4">
                <div class="row d-flex align-items-center">
                    <div v-for="(url, key) in urls" :key="url" class="col-12 col-md-3 my-2 px-2">
                        <div class="card shadow border border-dark">
                            <img :src="url" class="card-img-top img-heigth" alt="Preview">
                            <div class="card-body p-0 border-top border-dark">
                                <button :disabled="newImages.processing"
                                    class="col-12 fw-bold btn btn-danger rounded-0 rounded-bottom p-0 m-0"
                                    @click="deleteImage(key)">
                                    Elimina
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button class="btn btn-danger text-uppercase fw-bold" type="submit">
                        aggiungi le nuove immagini
                    </button>
                </div>
            </div>
        </div>
    </form>

</template>


<script>

import { useForm } from '@inertiajs/inertia-vue3';

export default {
    data() {
        return {
            files: [],
            urls: [],
        };
    },
    emits: ['value'],
    props: {
        announcement_id: Number,
        user_id: Number,
    },
    setup(props) {

        const newImages = useForm({
            images: [],
            announcement_id: props.announcement_id,
            user_id: props.user_id,
        });

        return { newImages };
    },
    methods: {
        submitImage() {
            this.newImages.images = this.files;
            this.newImages.post(route('image.update'),
                {
                    onSuccess: () => {
                        this.newImages.images = [];
                        this.$emit('value', true);
                    }
                });
        },
        previewImage(e) {
            this.files = Array.from(e.target.files);
            this.files.forEach((item) => {
                this.urls.push(URL.createObjectURL(item));
            });
        },
        deleteImage(number) {
            this.urls.splice(number, 1);
            this.files.splice(number, 1);
            document.querySelector('#inputImage').value = "";
        },
    }
}

</script>

<style scoped>
.img-heigth {
    max-height: 300px;
}
</style>