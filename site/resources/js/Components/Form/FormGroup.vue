<template>
    <div class="mb-3 form-check has-validation" v-if="groupType === 'checkbox'" :class="{
        'has-validation': hasValidation
    }">
        <slot />
        <FormLabel :label="label" />
    </div>
    <div v-else class="mb-3" :class="{
        'has-validation': hasValidation
    }">
        <FormLabel :label="label" />
        <slot />
    </div>
</template>

<script>
import {isEmpty} from "lodash";
import FormLabel from "./FormLabel.vue";

export default {
    name: "FormGroup",
    components: {FormLabel},
    methods: {isEmpty},
    props: {
        groupType: {
           type: String,
            default: 'default'
        },
        label: {
            type: String,
            default: ''
        },
        hasValidation: {
            type: Boolean,
            default: false
        }
    }
}
</script>
<style scoped>

</style>
