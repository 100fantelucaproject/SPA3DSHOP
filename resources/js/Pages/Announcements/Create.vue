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
                                            <input type="file" multiple @change="previewImage" ref="images" />
                                        </div>
                                        <img v-if="url" :src="url" />
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
import { ref, refs, useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

export default {
    props: {
        errors: Object,
        categories: Object,
    },
    data() {
        return {
            url: null,
        };
    },
    setup() {
        const form = useForm({
            title: '',
            description: '',
            price: '',
            images: [],
            category_id: '',
        });

        return { form };
    },
    components: {
        AppLayout,
        JetValidationErrors,
    },
    methods: {
        submit() {
            if (this.$refs.images) {
                this.form.images = this.$refs.images.files;
            }
            this.form.post(route('announcement.store'));
        },
        previewImage(e) {
            const file = e.target.files[0];
            this.url = URL.createObjectURL(file);
        },
    }
}

</script>