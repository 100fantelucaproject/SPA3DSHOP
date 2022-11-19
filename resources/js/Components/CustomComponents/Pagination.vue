<template>
    <span v-for="link in elements.meta.links">
        <Link v-if="link.url" :href="link.url" v-html="link.label"
            class="p-2 text-decoration-none text-light fw-bold border border-dark" 
            :class="SetPaginationClasses(link.active, elements.meta.current_page, elements.meta.last_page)" />
        <span class="p-2" v-else v-html="link.label"></span>
    </span>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    data(){
        return{
            stylePagination: false,
        };
    },
    props: {
        elements: Object,
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