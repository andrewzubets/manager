<template>
    <nav v-if="!isEmpty(pagination) && pagination.has_pages">
        <ul class="pagination">
            <li class="page-item">
                <span v-if="!pagination.has_prev_pages" class="page-link">
                    Пред.
                </span>
                <a v-if="pagination.has_prev_pages" class="page-link" style="cursor: pointer" @click.prevent="$emit('onPageClick', pagination.previous_page)">
                    Пред.
                </a>
            </li>
            <li class="page-item">
                <span v-if="!pagination.has_more_pages" class="page-link">
                    След.
                </span>
                <a v-if="pagination.has_more_pages" class="page-link" style="cursor: pointer" @click.prevent="$emit('onPageClick', pagination.next_page)">
                    След.
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
import {isEmpty} from "lodash";

export default {
    name: "Pagination",
    methods: {isEmpty},
    props: {
        pagination: Object,
    }
}
</script>

<style scoped>

</style>
