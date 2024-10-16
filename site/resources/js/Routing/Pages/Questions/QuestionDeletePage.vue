<template>
    <h1>Удалить вопрос # {{ $route.params.id }}</h1>
    <Breadcrumbs :items="breadcrumbs" />
    <Preloader v-if="is_loading && !is_not_found" />
    <not-found404 :is_visible="is_not_found" message="Question not found." />
    <div v-if="!is_loading && !is_not_found">
        <p>Вы действительно хотите удалить вопрос "{{ question.name }}"? </p>
        <FormSubmit @click.prevent="onSubmit" label="Удалить" />
        <RouterLink
            :to="getQuestionsRoute('edit', {id: $route.params.id})"
            class="btn btn-secondary mx-2">
            Отмена
        </RouterLink>
    </div>
</template>

<script>
import {useRoute} from "vue-router";
import Preloader from "../../../../vue/Components/Preloader.vue";
import {store} from "../../../../vue/store";
import {
    axiosDeleteQuestion,
    axiosGetQuestion,
    getQuestionsBreadcrumbs,
    getQuestionsRoute
} from "../../../api/questions";
import FormSubmit from "../../../../vue/Components/Form/FormSubmit.vue";
import NotFound404 from "../../../../vue/Components/NotFound404.vue";
import Breadcrumbs from "../../../../vue/Breadcrumbs/Breadcrumbs.vue";

export default {
    name: "QuestionDeletePage",
    components: {Breadcrumbs, NotFound404, FormSubmit, Preloader},
    data() {
        const route = useRoute();
        return {
            name: '',
            id: route.params.id,
            is_loading: true,
            is_not_found: false,
            breadcrumbs: getQuestionsBreadcrumbs({
                page: route.query.page ?? 1,
                id: route.params.id
            }),
            question: {

            }
        };
    },
    methods: {
        getQuestionsRoute,
        loadQuestion() {
            const route = useRoute();
            axiosGetQuestion(route.params.id, (r) => {
                this.question = r;
                this.is_loading = false;
            },(r)=>{
                this.is_loading = false;
                if(r.response.status === 404){
                    this.is_not_found = true;
                }
            });

        },
        onSubmit() {
            axiosDeleteQuestion(this.id).then((r) =>{
                if(r.status === 200){
                    store.notify('warning', 'Вопрос удален');
                    this.$router.push(getQuestionsRoute('list'));
                }else{
                    console.warn('unknown response', r);
                }
            } );
        },
    },
    mounted() {
        store.flushNotifications();
        this.loadQuestion();
    }
}
</script>

<style scoped>

</style>
