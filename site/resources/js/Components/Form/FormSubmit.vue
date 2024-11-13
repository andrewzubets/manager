<template>
    <button type="submit" class="btn btn-primary" >{{ label }}</button>
</template>

<script>
export default {
    name: "FormSubmit",
    props: {
        label: String
    }
}
</script>

<style scoped>

</style>
