<template>
    <Navbar :topMenu="topMenu" />
    <div class="container-fluid">
    <router-view></router-view>
    </div>
</template>

<script setup>
const props = defineProps(['top-menu','meta_title']);
const {topMenu} = props;

</script>
<script>
import Navbar from "./Navbar/Navbar.vue";

export default {
    name: "RootComponent",
    components: {Navbar}
}
</script>

<style scoped>

</style>
