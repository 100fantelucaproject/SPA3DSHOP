<template>
    <AppLayout>
        <div v-if="announcements.data.length != 0">
            <div class="container-fluid">
                <div class="row d-flex justify-content-around">
                    <div class="col-6 col-md-4 col-lg-3 m-1" v-for="announcement in announcements.data"
                        :key="announcement.id">
                        <Card :announcement="announcement" />
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="p-2 text-center">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center">
                    <h3 class="fw-bold">Non hai ancora creato nessun annuncio, creane uno: </h3>
                    <div>
                        <button class="btn btn-danger">Crea un annuncio</button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue';
import Card from '../../Components/CustomComponents/CardAnnouncement.vue';

export default {
    components: {
        AppLayout,
        Card,
    },
    props: {
        announcements: Object,
    },
}

</script>