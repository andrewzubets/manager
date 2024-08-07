<template>
<h1>Questions</h1>
    <DataList :items="items" />
</template>

<script>
import DataList from "../../../../vue/DataList/DataList.vue";

export default {
    name: "QuestionListPage",
    components: {DataList},
    data: () => ({
       items: [{}],
    }),
    methods: {
        async loadList() {
            axios.get('/api/questions')
                .then((r)=>{
                    this.items = r.data.items
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
