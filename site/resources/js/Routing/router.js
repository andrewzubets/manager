import { createRouter } from 'vue-router'
import HomePage from "./Pages/HomePage.vue";
import QuestionsPage from "./Pages/QuestionsPage.vue";

const routes = [
    {
        path: '/',
        component: HomePage,
        name: 'home'
    },
    {
        path: '/questions',
        component: QuestionsPage,
        name: 'questions'
    },
    {
        path: '/questions/new',
        component: QuestionsPage,
        name: 'questions'
    }
]
export default function(history) {
    return createRouter({
        history,
        routes
    });
}
