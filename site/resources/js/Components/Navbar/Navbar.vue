<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <Brand href="/" label="Manager" />
            <TogglerButton />
            <div class="collapse navbar-collapse">
                <Menu v-if="isObject(topMenu)" :items="topMenu.left" :active_route="active_route" @onDropdown="onDropdown" />
            </div>
        </div>
    </nav>
</template>

<script setup>
import {isObject} from "lodash";

function onDropdown(v){
    //v.expanded = !v.expanded;
}
const props = defineProps(['topMenu']);

</script>
<script>
import TogglerButton from "./Head/TogglerButton.vue";
import Brand from "./Head/Brand.vue";
import Menu from "./Menu/Menu.vue";
import {store} from "@store/store";

export default {
    name: "Navbar",
    components: {Menu, Brand, TogglerButton},

    computed: {
        active_route: () => {
            return store.activeRoute;
        }
    }
}
</script>

<style scoped>

</style>
