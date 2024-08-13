<template>
    <nav aria-label="breadcrumb" v-if="isArray(items)">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" v-for="item in items">
                <RouterLink :to="item.href">{{ item.label }}</RouterLink>
            </li>
        </ol>
    </nav>
</template>

<script>
import {isArray} from "lodash";

export default {
    name: "Breadcrumbs",
    methods: {isArray},
    props: {
        items: Array
    }
}
</script>

<style scoped>

</style>
