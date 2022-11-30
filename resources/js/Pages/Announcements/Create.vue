<template>
    <AppLayout title="Create post">
        <div class="container-fluid my-5 p-5">
            <div class="row d-flex justify-content-center align-content-center">
                <div class="col-0 col-lg-2"></div>
                <div class="col-12 col-lg-8">
                    <div class="card rounded-4 border-dark border border-1 shadow-lg">
                        <div class="row m-0 p-0 justify-content-center">
                            <div class="col-12 col-lg-6 text-center welcome-view d-none d-lg-block">
                                <div class="row d-flex justify-content-center align-content-center align-items-center">
                                    <div class="col-12 text-uppercase ">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 ">
                                <div class="card-body">
                                    <h5 class="card-title text-center text-uppercase fw-bold">INSERISCI IL TUP POST</h5>
                                    <form class="mb-3" enctype="multipart/form-data" @submit.prevent="submit">
                                        {{ errors }}
                                        <div class="mb-3">
                                            <label for="title" class="form-label fw-bold">Titolo</label>
                                            <input v-model="form.title" type="text" class="form-control" id="title" />
                                            <div v-if="errors.title" class="text-danger"> {{ errors.title }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label fw-bold">Descrizione</label>
                                            <input v-model="form.description" type="text" class="form-control"
                                                id="description" />
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label fw-bold">Prezzo</label>
                                            <input v-model="form.price" type="number" class="form-control" id="price" />
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" aria-label="Default select example"
                                                v-model="form.category_id">
                                                <option selected value="">Seleziona una categoria</option>
                                                <option v-for="category in categories" :value="category.id">
                                                    {{ category.name }}</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="file">Carica qui le tua immagini di presentazione</label>
                                            <input type="file" multiple @change="previewImage" ref="images"/>
                                        </div>
                                        <div v-if="urls.length > 0">
                                            <div v-for="(url, key) in urls" :key="url">
                                                <img :src="url" class="img-fluid">
                                                <button class="btn btn-danger" @click="deleteImage(key)">
                                                    Elimina
                                                </button>
                                            </div>
                                        </div>
                                        <div class="text-center mb-3">
                                            <button :disabled="form.processing" class="btn btn-danger" type="submit">
                                                submit
                                            </button>
                                        </div>
                                    </form>
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
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AppLayout,
        JetValidationErrors,
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            files: [],
            urls: [],
        };
    },
    setup() {
        const categories = computed(() => usePage().props.value.categories);

        const form = useForm({
            title: '',
            description: '',
            price: '',
            images: [],
            category_id: '',
        });

        return { form, categories };
    },

    methods: {
        submit() {
            if (this.$refs.images) {
                this.form.images = this.files;
            }
            this.form.post(route('announcement.store'));
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
