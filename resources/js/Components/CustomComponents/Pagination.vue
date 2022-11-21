<template>
    <span v-for="link in announcements.meta.links">
        <Link v-if="link.url" 
        :href="link.url + 
        '&orderColumn=' + researchData.orderColumn +
        '&order=' + researchData.order +
        '&search_global=' + researchData.textSearch +
        '&priceMin=' + researchData.rangePrice.priceMin +
        '&priceMax=' + researchData.rangePrice.priceMax +
        '&category=' + researchData.category
        " 
        v-html="link.label"
            class="p-2 text-decoration-none text-light fw-bold border border-dark" 
            :class="SetPaginationClasses(link.active, announcements.meta.current_page, announcements.meta.last_page)" />
        <span class="p-2" v-else v-html="link.label"></span>
    </span>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    props: {
        elements: Object,
        researchData: Object,
    },
    data(){
        return{
            stylePagination: false,
        };
    },
    setup(props){
        const announcements = props.elements;
        return { announcements };
    },
    components: {
        Link,
    },
    methods:{
        SetPaginationClasses(activeLink, currentPage, lastPage){
            return { 
                'bg-dark': activeLink,
                'bg-light': !activeLink,
                'text-dark': !activeLink,
                'd-none': (
                    ((parseInt(activeLink)) < (currentPage - 2))
                    ||
                    ((parseInt(activeLink)) > (currentPage + 2))
                ),
                'rounded-start': activeLink,
                'rounded-end': (activeLink == lastPage),
            };
        },

    }
}
</script>