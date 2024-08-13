<template>
    <h1>Редактировать вопрос # {{ $route.params.id }}</h1>
    <Breadcrumbs :items="breadcrumbs" />
</template>

<script>
import Breadcrumbs from "../../../../vue/Breadcrumbs/Breadcrumbs.vue";
import {useRoute} from "vue-router";


export default {
    name: "QuestionEditPage",
    components: {Breadcrumbs},
    data: () => {
        const route = useRoute();
        return {
          breadcrumbs: [
              {href: '/',label: 'Главная'},
              {href: '/questions/edit/' + route.params.id,label: 'Редактировать вопрос'},
          ]
        };
    }
}
</script>

<style scoped>

</style>
