<template>
    <h1>Вопросы</h1>
    <Breadcrumbs :items="breadcrumbs" />
    <Preloader v-if="is_loading" />
    <DataList v-if="!is_loading" :items="items" />
</template>

<script>
import DataList from "../../../../vue/DataList/DataList.vue";
import Breadcrumbs from "../../../../vue/Breadcrumbs/Breadcrumbs.vue";
import Preloader from "../../../../vue/Components/Preloader.vue";


export default {
    name: "QuestionListPage",
    components: {Preloader, Breadcrumbs, DataList},
    data: () => ({
       items: [],
        is_loading: true,
        breadcrumbs: [
            {href: '/',label: 'Главная'},
            {href: '/questions',label: 'Вопросы'},
        ]
    }),
    methods: {
        async loadList() {
            axios.get('/api/questions')
                .then((r)=>{
                    this.items = r.data.items;
                    this.is_loading = false;
                });

        }
    },
    mounted() {
      this.loadList();
    }
}
</script>

<style scoped>

</style>
