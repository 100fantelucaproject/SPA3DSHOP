<template>
    <AppLayout title="Create announcement">
        <div class="container-fluid my-5 p-1">
            <div class="row d-flex justify-content-center align-content-center mx-0 px-0">
                <div class="col-0 col-lg-1"></div>
                <div class="col-12 col-lg-8">
                    <div class="card rounded-4 border-dark border border-1 shadow-lg">
                        <div class="row m-0 p-0 justify-content-center">
                            <div class="col-12">
                                <div class="card-body">
                                    <h1 class="card-title text-center text-uppercase fw-bold">insert your announcement
                                    </h1>
                                    <form class="mb-3" enctype="multipart/form-data" @submit.prevent="submit">
                                        <div class="mb-3">
                                            <label for="title" class="form-label fw-bold">Title</label>
                                            <input v-model="form.title" type="text" class="form-control"
                                                :class="{ 'is-invalid': errors.title }" id="title" />
                                            <div v-if="errors.title" class="text-danger"> {{ errors.title }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label fw-bold">Description</label>
                                            <textarea v-model="form.description" type="text" class="form-control"
                                                :class="{ 'is-invalid': errors.description }" id="description"
                                                rows="4"></textarea>
                                            <div v-if="errors.description" class="text-danger"> {{ errors.description }}
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price" class="form-label fw-bold">Price</label>
                                            <input v-model="form.price" type="number" class="form-control"
                                                :class="{ 'is-invalid': errors.price }" id="price" />
                                            <div v-if="errors.price" class="text-danger"> {{ errors.price }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <select class="form-select" :class="{ 'is-invalid': errors.category_id }"
                                                aria-label="Default select example" v-model="form.category_id">
                                                <option selected value="">Select a category</option>
                                                <option v-for="category in categories" :value="category.id">
                                                    {{ category.name }}</option>
                                            </select>
                                            <div v-if="errors.category_id" class="text-danger"> {{ errors.category_id }}
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="file" class="fw-bold">Load here your 3d file</label>
                                            <input class="form-control" :class="{ 'is-invalid': errors.file }"
                                                type="file" ref="file" @change="handleSelected" />
                                            <div v-if="currentProgress !== '0%'" class="text-center fw-bold py-2">
                                                {{ currentProgress }}</div>
                                            <div v-if="errors.file" class="text-danger"> {{ errors.file }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="file" class="fw-bold">Load here your presentation's
                                                images</label>
                                            <input class="form-control" :class="{ 'is-invalid': errors.images }"
                                                type="file" id="inputImages" multiple @change="previewImage"
                                                ref="images" />
                                            <div v-if="errors.images" class="text-danger"> {{ errors.images }}</div>
                                        </div>
                                        <div v-if="urls.length > 0">
                                            <h6 class="text-center text-uppercase fw-bold">Images preview</h6>
                                            <div class="container border border-dark rounded-2 shadow my-4">
                                                <div class="row d-flex align-items-center">
                                                    <div v-for="(url, key) in urls" :key="url"
                                                        class="col-12 col-md-3 my-2 px-2">
                                                        <div class="card shadow border border-dark">
                                                            <img :src="url" class="card-img-top img-heigth"
                                                                alt="Preview">
                                                            <div class="card-body p-0 border-top border-dark">
                                                                <button
                                                                    class="col-12 fw-bold btn btn-danger rounded-0 rounded-bottom p-0 m-0"
                                                                    @click="deleteImage(key)">
                                                                    delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center mb-3">
                                            <button :disabled="form.processing"
                                                class="btn btn-danger text-uppercase fw-bold fs-4" type="submit">
                                                <span v-show="form.processing" class="spinner-border spinner-border-sm"
                                                    role="status">
                                                </span>
                                                submit
                                            </button>
                                            <div class="p-2 text-uppercase fw-bold" v-show="form.processing">Please
                                                wait, we are uploading your file !!!</div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-0 col-lg-1"></div>
            </div>
        </div>
    </AppLayout>
</template>

<script>

import { useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
import { computed } from 'vue';
import { usePage } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

export default {
    components: {
        AppLayout,
    },
    props: {
        errors: Object,
    },
    data() {
        return {
            filesImages: [],
            urls: [],
        };
    },
    setup() {
        const categories = computed(() => usePage().props.value.categories);

        const reader = new FileReader();
        const fileUrl = ref(null);
        const totalSize = ref(0);
        const currentProgress = ref('0%');

        const form = useForm({
            title: '',
            description: '',
            price: '',
            images: [],
            file: null,
            category_id: '',
        });

        //Handle file upload (UX, User can see file's percentage upload)
        function handleEvent(event) {
            if (['loadend', 'load'].includes(event.type)) {
                currentProgress.value = 'Finished loading file';
                fileUrl.value = reader.result;
            }
            if (event.type === 'progress') {
                currentProgress.value = 'Loading: ' + `${(event.loaded / totalSize.value).toFixed(2) * 100}%`;
            }
            if (event.type === 'loadstart') {
                totalSize.value = event.total;
            }
        }

        function addListeners(reader) {
            reader.addEventListener('loadstart', handleEvent);
            reader.addEventListener('load', handleEvent);
            reader.addEventListener('loadend', handleEvent);
            reader.addEventListener('progress', handleEvent);
            reader.addEventListener('error', handleEvent);
            reader.addEventListener('abort', handleEvent);
        }

        function handleSelected(e) {
            const selectedFile = e.target.files[0];
            if (selectedFile) {
                addListeners(reader);
                reader.readAsDataURL(selectedFile);
            }
        }

        return {
            form,
            categories,
            handleSelected,
            fileUrl,
            currentProgress
        };

    },
    methods: {
        submit() {
            if (this.$refs.images) {
                this.form.images = this.filesImages;
            }
            if (this.$refs.file) {
                this.form.file = this.$refs.file.files[0];
            }
            this.form.post(route('announcement.store'));
        },
        previewImage(e) {
            this.filesImages = Array.from(e.target.files);
            this.filesImages.forEach((item) => {
                this.urls.push(URL.createObjectURL(item));
            });
        },
        deleteImage(number) {
            this.urls.splice(number, 1);
            this.filesImages.splice(number, 1);
        },

    }
}

</script>

<style scoped>
.img-heigth {
    max-height: 300px;
}
</style>
