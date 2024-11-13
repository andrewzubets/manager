<template>
    <div v-for="message in messages" class="alert" :class="'alert-' + message.type"  style="margin-top: 15px;">
        {{ message.message }}
    </div>
</template>

<script>

import {store} from "@store/store";

export default {
    name: "Notifications",
    computed: {
        messages: () => {
            return store.notifications;
        }
    }
}
</script>

<style scoped>

</style>
