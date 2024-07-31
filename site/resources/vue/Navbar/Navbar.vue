<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <Brand href="/" label="Manager" />
            <TogglerButton />
            <div class="collapse navbar-collapse">
                <Menu :items="topMenu.left" :active_route="active_route" @onDropdown="onDropdown" />
            </div>
        </div>
    </nav>
</template>

<script setup>
function onDropdown(v){
    //v.expanded = !v.expanded;
}
const props = defineProps(['topMenu']);


const leftMenu = [
    {
        href: '/',
        label: 'Label',
        route: 'home',
        active_routes: ['home'],
        sub: null
    },
    {
        href: '/vue',
        label: 'Label 2',
        route: 'home2',
        active_routes: ['home2'],
        sub: null
    },
    {
        href: '#',
        label: 'Label Sub',
        route: 'homeSub',
        active_routes: ['homeSub'],
        sub: [
            {
                href: '/questions',
                label: 'sub 1',
                route: 'sub1',
                active_routes: ['homeSub'],
                sub: null
            },
            {
                href: '/vue',
                label: 'sub 2',
                route: 'sub2',
                active_routes: ['homeSub'],
                sub: null
            },
        ]
    },
];

</script>
<script>
import TogglerButton from "./Head/TogglerButton.vue";
import Brand from "./Head/Brand.vue";
import Menu from "./Menu/Menu.vue";
import {store} from "../store";

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
