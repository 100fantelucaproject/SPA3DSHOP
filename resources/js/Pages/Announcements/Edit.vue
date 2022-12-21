<template>
    <AppLayout title="Edit announcement">
        <div class="container-fluid my-5 p-5">
            <div class="row d-flex justify-content-center align-content-center">
                <div class="col-0 col-lg-2"></div>
                <div class="col-12 col-lg-8">
                    <div class="card rounded-4 border-dark border border-1 shadow-lg">
                        <div class="row m-0 p-0 justify-content-center">
                            <div class="col-12">
                                <div class="card-body">
                                    <h1 class="card-title text-center text-uppercase fw-bold">{{ $t("common.modifyAnnouncement") }}</h1>
                                    <form class="mb-3" @submit.prevent="submit">
                                        <div class="mb-3">
                                            <label for="title" class="form-label fw-bold">{{ $t("common.title") }}</label>
                                            <input v-model="form.title" type="text" class="form-control"
                                                :class="{ 'is-invalid': errors.title }" id="title" />
                                            <div v-if="errors.title" class="text-danger"> {{ errors.title }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label fw-bold">{{ $t("common.description") }}</label>
                                            <textarea v-model="form.description" type="text" class="form-control"
                                                :class="{ 'is-invalid': errors.description }" id="description"
                                                rows="5"></textarea>
                                            <div v-if="errors.description" class="text-danger"> {{ errors.description }}
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label fw-bold">{{ $t("common.price") }}</label>
                                            <input v-model="form.price" type="number" class="form-control"
                                                :class="{ 'is-invalid': errors.price }" id="price" />
                                            <div v-if="errors.price" class="text-danger"> {{ errors.price }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" :class="{ 'is-invalid': errors.category_id }"
                                                aria-label="Default select example" v-model="form.category_id">
                                                <option v-for="category in categories" :value="category.id">
                                                    {{ category.name }}</option>
                                            </select>
                                            <div v-if="errors.category_id" class="text-danger"> {{ errors.category_id }}
                                            </div>
                                        </div>
                                        <div class="text-center mb-3">
                                            <button :disabled="form.processing"
                                                class="btn btn-danger fw-bold text-uppercase" type="submit">
                                                <div v-show="form.processing" class="spinner-border spinner-border-sm"
                                                    role="status">
                                                </div>
                                                {{ $t("common.submit") }}
                                            </button>
                                            <div class="p-2 text-uppercase fw-bold" v-show="form.processing">
                                                {{ $t("common.wait") }}!!!</div>
                                        </div>
                                    </form>
                                    <div class="mb-3">
                                        <div class="text-center fw-bold">
                                            <h2>{{ $t("common.uploadedImages") }}</h2>
                                        </div>
                                        <div v-if="form.images.length > 0">
                                            <div class="container border border-dark rounded-2 shadow my-4">
                                                <div class="row d-flex align-items-center">
                                                    <div v-for="image in form.images" :key="image.id"
                                                        class="col-12 col-md-3 my-2 px-2">
                                                        <div class="card shadow border border-dark">
                                                            <img :src="('/storage/' + image.path)"
                                                                class="card-img-top img-heigth" alt="Preview">
                                                            <div class="card-body p-0 border-top border-dark">
                                                                <button
                                                                    class="col-12 fw-bold btn btn-danger rounded-0 rounded-bottom p-0 m-0"
                                                                    @click="destroyImage(image)">{{ $t("common.delete") }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <UploadImage :announcement_id="announcement.id" :user_id="announcement.user_id"
                                        @value="() => changed = true" />
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
import { Inertia } from '@inertiajs/inertia';
import UploadImage from '../../Components/CustomComponents/UploadImage.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';

export default {
    components: {
        AppLayout,
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
            images: props.announcement.images,
            category_id: props.announcement.category_id,
        });

        //Destroy old image
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

        //Upload announcement
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

<style scoped>
.img-heigth {
    max-height: 300px;
}
</style>