<template>
<div v-if="is_visible" class="p-3">
    <h1 style="font-size: 36px;">404</h1>
    <hr />
    <strong>{{ message }}</strong>
</div>
</template>

<script>
export default {
    name: "NotFound404",
    props: {
        is_visible: {
            type: Boolean,
            default: false
        },
        message: {
            type: String,
            default: 'Page not found.'
        }
    }

}
</script>

<style scoped>

</style>
