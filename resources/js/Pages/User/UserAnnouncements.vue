<template>
    <AppLayout title="Your announcement">
        <div v-if="announcements.data.length != 0">
            <div class="container-fluid">
                <div class="row d-flex ">
                    <div class="col-12 col-lg-4 p-2" v-for="(announcement, index) in announcements.data"
                        :key="announcement.id">
                        <Card :announcement="announcement" :images="images[index]" />
                    </div>
                </div>
                <div class="my-4">
                    <Pagination :elements="announcements" :researchData="null" :dataSearch="false"></Pagination>
                </div>
            </div>
        </div>
        <div v-else class="p-2 text-center">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <h3 class="fw-bold">{{ $t("user.announcementNotCreated") }}: </h3>
                    <div>
                        <Link :href="route('announcement.create')" class="btn btn-danger">
                            {{ $t("user.createAnnouncement") }}
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>

import AppLayout from '../../Layouts/AppLayout.vue';
import Card from '../../Components/CustomComponents/CardAnnouncement.vue';
import Pagination from '../../Components/CustomComponents/Pagination.vue'; 
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
        AppLayout,
        Card,
        Pagination,
    },
    props: {
        announcements: Object,
        images: Object,
    },
}

</script>