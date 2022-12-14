<template>
    <div v-if="dataSearch == false">
        <span v-for="link in announcements.meta.links">
            <Link v-if="link.url" :href="link.url" v-html="link.label"
                class="p-2 text-decoration-none text-light fw-bold border border-dark"
                :class="SetPaginationClasses(link.active)" />
            <span class="p-2" v-else v-html="link.label"></span>
        </span>
    </div>
    <div v-else-if="dataSearch == true">
        <span v-for="( link, index) in announcements.meta.links">
            <span v-if="link.url" class="m-0 p-0">
                <Link :href="link.url +
                '&orderColumn=' + researchData.orderColumn +
                '&order=' + researchData.order +
                '&search_global=' + researchData.textSearch +
                '&priceMin=' + researchData.rangePrice.priceMin +
                '&priceMax=' + researchData.rangePrice.priceMax +
                '&category=' + researchData.category" v-html="link.label"
                class="px-2 py-1 m-1 text-decoration-none text-light fw-bold fs-5 border border-dark rounded"
                :class="SetPaginationClasses(link.active)" />
            </span>
            <span class="p-0 m-0" v-else>
            </span>
        </span>
    </div>
</template>

<script>

import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link,
    },
    props: {
        elements: Object,
        researchData: Object,
        dataSearch: Boolean,
    },
    data() {
        return {
            stylePagination: false,
        };
    },
    setup(props) {
        const announcements = props.elements;
        
        return { announcements };
    },
    methods: {
        SetPaginationClasses(activeLink) {
            return {
                'bg-dark': activeLink,
                'bg-light': !activeLink,
                'text-dark': !activeLink,
            };
        },

    }
}
</script>