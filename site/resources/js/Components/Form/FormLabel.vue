<template>
    <label v-if="label !== ''" class="form-label">{{ label }}</label>
</template>

<script>
export default {
    name: "FormLabel",
    props: {
        label: {
            type: String,
            default: ''
        }
    }
}
</script>

<style scoped>

</style>
