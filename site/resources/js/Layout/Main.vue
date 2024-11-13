<template>
    <Navbar :topMenu="topMenu" />
    <div class="container-fluid">
        <notifications />
        <router-view></router-view>
    </div>
</template>

<script>
import Navbar from "@components/Navbar/Navbar.vue";
import Notifications from "@components/Notifications.vue";

export default {
    name: "Main",
    components: {Notifications, Navbar},
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
