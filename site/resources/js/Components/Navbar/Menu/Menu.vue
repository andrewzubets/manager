<template>
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li :class="itemCssClass(item)" v-for="item in items">
            <MenuItem v-bind="item" />
        </li>
    </ul>
</template>

<script setup>
import MenuItem from "./MenuItem.vue";

const props = defineProps({
    items: Array,
    active_route: String
});
const itemCssClass = function (item) {
    let cssClass = 'nav-item';
    if(item.sub !== null){
        cssClass+=' dropdown';
    }
    return cssClass;
};
</script>
<script>


export default {
    name: "Menu",
}
</script>

<style scoped>

</style>
