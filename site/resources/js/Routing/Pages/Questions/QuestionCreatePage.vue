<template>
    <h1>Добавить вопрос</h1>
    <Breadcrumbs :items="breadcrumbs" />
    <Preloader v-if="is_loading" />
    <form v-if="!is_loading">
        <FormGroup label="Включен" group-type="checkbox">
            <input class="form-check-input" type="checkbox" v-model="question.is_enabled" />
        </FormGroup>
        <FormGroup label="Название" has-validation="true">
            <input type="text" class="form-control" :class="{
                'is-invalid': errors.name.length > 0
            }" v-model="question.name" placeholder="Название" />
            <div class="invalid-feedback">
                {{ errors.name }}
            </div>
        </FormGroup>
        <FormSubmit @click.prevent="onSubmit" label="Добавить" />
    </form>
</template>

<script>
import FormGroup from "@components/Form/FormGroup.vue";
import FormSubmit from "@components/Form/FormSubmit.vue";
import Breadcrumbs from "@components/Breadcrumbs.vue";
import Preloader from "@components/Preloader.vue";
import {axiosCreateQuestion, getQuestionsBreadcrumbs, getQuestionsRoute } from "@api/questions";
import {store} from "@store/store";

export default {
    name: "QuestionCreatePage",
    components: {Preloader, FormGroup, FormSubmit, Breadcrumbs},
    data: () => {
        return {
            question: {
                is_enabled: true,
                name: '',
            },
            errors: {
                name: '',
            },
            is_loading: false,
            breadcrumbs:
                getQuestionsBreadcrumbs({
                    add: true
                })

        };
    },
    methods: {
        onSubmit() {
            this.is_loading = true;
            axiosCreateQuestion(this.question).then((r)=>{
                store.notify('success', 'Добавлен вопрос');
                this.$router.push(getQuestionsRoute('list'));
            },(r) => {
                if (r.code === 'ERR_BAD_REQUEST'){
                    const data = r.response.data;
                    this.errors.name = data.errors.name[0] ?? '';
                }
                this.is_loading = false;
            });
        },

    },
    mounted() {
        store.flushNotifications();
    }
}
</script>

<style scoped>

</style>
