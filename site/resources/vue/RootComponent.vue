<template>
    <Navbar :topMenu="topMenu" />
    <div class="container-fluid">
        <notifications />
        <router-view></router-view>
    </div>
</template>

<script setup>

import Notifications from "./Components/Notifications.vue";

</script>
<script>
import Navbar from "./Navbar/Navbar.vue";

export default {
    name: "RootComponent",
    components: {Navbar},
    props: {
        topMenu: {
            type: Object
        },
        metaTitle: {
            type: String,
            default: 'Manager'
        }
    },
}
</script>

<style scoped>

</style>
