<template>
    <Navbar />
    <router-view>

    </router-view>
</template>

<script setup>
const props = defineProps(['aaa']);
console.log('root',props);
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
