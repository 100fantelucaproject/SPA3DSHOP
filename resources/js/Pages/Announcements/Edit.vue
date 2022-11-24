<template>
    <AppLayout title="Edit post">
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
                                    <form class="mb-3" @submit.prevent="form.put(route('announcement.update', form))">
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
                                                <option v-for="category in categories" :value="category.id">
                                                    {{ category.name }}</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <div v-if="form.images.length > 0">
                                                <div v-for="(image, key) in form.images" :key="key">
                                                    <img :src="'/storage/' + image.path" class="img-fluid p-2">
                                                    <button class="btn btn-danger" >
                                                        elimina
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mb-3">
                                            <button :disabled="form.processing" class="btn btn-danger" type="submit">
                                                modifica
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
import { Inertia } from '@inertiajs/inertia';

export default {
    props: {
        announcement: Object,
        errors: Object,
        categories: Object,
    },
    setup(props) {
        const form = useForm(props.announcement);
        console.log(props.announcement);

            return { form };
        },
            components: {
                AppLayout,
                JetValidationErrors,
            },


    }

</script>