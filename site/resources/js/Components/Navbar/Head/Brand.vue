<template>
    <router-link :to="href" class="navbar-brand">{{ label }}</router-link>
</template>

<script>
export default {
    name: "Brand",
    props: {
        label: String,
        href: String
    }
}
</script>

<style scoped>

</style>
