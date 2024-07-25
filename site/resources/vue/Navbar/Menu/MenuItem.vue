<template>
    <router-link
        v-if="isSub === false"
        :to="href"
        class="nav-link"
        activeClass="active"
    >{{ label }}</router-link>
    <a v-if="isSub" :class="linkCssClass" :href="href" @click="toggleExpanded">
        {{ label }}
    </a>
    <ul v-if="isSub" :class="listCssClass">
        <li class="nav-item" v-for="item in sub">
            <MenuItem v-bind="item" />
        </li>
    </ul>
</template>
<script setup>
import {computed, ref, useAttrs} from "vue";

const props = defineProps({
    sub: Object|null,
    href: String,
    label: String,
    route: String,
    active_routes: Array,
})
const attrs = useAttrs();
const isSub = props.sub !== null;
const expanded = ref(false);

function toggleExpanded(e) {
    if(isSub) {
        e.preventDefault();
        expanded.value = !expanded.value;
    }
}
const linkCssClass = computed(() => {
    let cssClass = 'nav-link dropdown-toggle';

    if(expanded.value){
        cssClass+=' show';
    }
    return cssClass;
});

const listCssClass = computed(() => {
    let cssClass = 'dropdown-menu';
    if(expanded.value){
        cssClass+=' show';
    }
    return cssClass;
});


</script>
<script>
export default {
    name: "MenuItem",
}
</script>

<style scoped>

</style>
