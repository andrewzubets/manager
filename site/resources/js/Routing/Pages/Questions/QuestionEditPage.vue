<template>
    <h1>Редактировать вопрос # {{ $route.params.id }}</h1>
    <Breadcrumbs :items="breadcrumbs" />
    <not-found404 :is_visible="is_not_found" message="Question not found." />
    <Preloader v-if="is_loading && !is_not_found" />
    <QuestionForm v-if="!is_loading && !is_not_found" submit-label="Сохранить" :on-submit="onSubmit" :question="question" />
</template>

<script>
import Breadcrumbs from "@components/Breadcrumbs.vue";
import {useRoute} from "vue-router";

import FormSubmit from "@components/Form/FormSubmit.vue";
import FormGroup from "@components/Form/FormGroup.vue";
import {
    axiosGetQuestion,
    axiosUpdateQuestion,
    getQuestionsBreadcrumbs,
    getQuestionsRoute
} from "@api/questions";
import Preloader from "@components/Preloader.vue";
import {store} from "@store/store";
import QuestionForm from "./QuestionForm.vue";
import NotFound404 from "@components/NotFound404.vue";

export default {
    name: "QuestionEditPage",
    components: {NotFound404, QuestionForm, Preloader, FormGroup, FormSubmit, Breadcrumbs},
    data: () => {
        const route = useRoute();

        return {
            question: {},
            errors: {
              name: ''
            },
            is_loading: true,
            is_not_found: false,
            breadcrumbs:
                getQuestionsBreadcrumbs({
                  page: route.query.page ?? 1,
                  id: route.params.id
              })
        };
    },
    methods: {
        onSubmit() {
            this.is_loading = true;
            axiosUpdateQuestion(this.question).then((r)=>{
                store.notify('success', 'Вопрос ' + this.$route.params.id + ' изменен');
                this.$router.push(getQuestionsRoute('list'));
            },(r) => {
                if (r.code === 'ERR_BAD_REQUEST'){
                    const data = r.response.data;
                    this.errors.name = data.errors.name[0] ?? '';
                }
                this.is_loading = false;
            });
        },
        loadQuestion() {
            const route = useRoute();
            axiosGetQuestion(route.params.id, (r) =>{
                this.question = r;
                this.is_loading = false;
            } , (r)=>{
                this.is_loading = false;
                if(r.response.status === 404){
                    this.is_not_found = true;
                }
            });
        }
    },
    mounted() {
        store.flushNotifications();
        this.loadQuestion();
    }
}
</script>

<style scoped>

</style>
