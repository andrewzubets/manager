import { createRouter } from 'vue-router'
import HomePage from "./Pages/HomePage.vue";
import QuestionEditPage from "./Pages/Questions/QuestionEditPage.vue";
import QuestionListPage from "./Pages/Questions/QuestionListPage.vue";
import QuestionCreatePage from "./Pages/Questions/QuestionCreatePage.vue";
import QuestionDeletePage from "./Pages/Questions/QuestionDeletePage.vue";

const routes = [
    {
        path: '/',
        component: HomePage,
        name: 'home'
    },
    {
        path: '/questions',
        component: QuestionListPage,
        name: 'question-list'
    },
    {
        path: '/questions/new',
        component: QuestionCreatePage,
        name: 'question-new'
    },
    {
        path: '/questions/edit/:id(\\d+)?',
        component: QuestionEditPage,
        name: 'question-edit'
    },
    {
        path: '/questions/delete/:id(\\d+)?',
        component: QuestionDeletePage,
        name: 'question-delete'
    }
]
export default function(history) {
    return createRouter({
        history,
        routes
    });
}
