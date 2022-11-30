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
                                    {{ errors }}
                                    <form class="mb-3" @submit.prevent="submit">
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
                                        <div class="text-center mb-3">
                                            <button :disabled="form.processing" class="btn btn-danger" type="submit">
                                                modifica
                                            </button>
                                        </div>
                                    </form>

                                    <UploadImage :announcement_id="announcement.id" :user_id="announcement.user_id"
                                        @value="() => changed = true" />

                                    <div class="mb-3">
                                        <h2>Immagini già caricate</h2>
                                        <div v-if="form.oldImages.length > 0">
                                            <div v-for="image in form.oldImages" :key="image.id">
                                                <img :src="'/storage/' + image.path" class="img-fluid" alt="">
                                                <button class="btn btn-warning"
                                                    @click="destroyImage(image)">elimina</button>
                                            </div>
                                        </div>
                                    </div>
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

import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import { Inertia } from '@inertiajs/inertia';
import UploadImage from '../../Components/CustomComponents/UploadImage.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AppLayout,
        JetValidationErrors,
        UploadImage,
    },
    props: {
        announcement: Object,
        errors: Object,
    },
    setup(props) {

        const categories = computed(() => usePage().props.value.categories);

        const changed = ref(false);

        const form = useForm({
            id: props.announcement.id,
            title: props.announcement.title,
            description: props.announcement.description,
            price: props.announcement.price,
            oldImages: props.announcement.images,
            category_id: props.announcement.category_id,
        });

        const destroyImage = (image) => {
            if (confirm('Ne sei sicuro?')) {
                Inertia.delete(route('image.delete', image),
                    {
                        onSuccess: () => {
                            changed.value = true;
                        }
                    });
            }
        }

        watch(changed, (current, previous) => {
            Inertia.get(route('announcement.edit', props.announcement.id));
        });


        return { form, destroyImage, changed, categories };
    },
    methods: {
        submit() {
            this.form.put(route('announcement.update', this.form));
        },
    }

}

</script>