<template>
    <form class="mb-3" @submit.prevent="submitImage">
        <div class="mb-3">
            <label for="file">Carica qui le tua immagini di presentazione</label>
            <input type="file" multiple @change="previewImage" ref="images" />
        </div>
        <button class="btn btn-danger text-uppercase" type="submit">
            aggiungi
        </button>
    </form>
    <div v-if="urls.length > 0">
        <h2>Immagini nuove</h2>
        <div v-for="(url, key) in urls" :key="url">
            <img :src="url" class="img-fluid">
            <button :disabled="newImages.processing" class="btn btn-danger" @click="deleteImage(key)">
                Elimina
            </button>
        </div>
    </div>
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
        },
    }
}

</script>