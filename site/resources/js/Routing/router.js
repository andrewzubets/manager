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
        path: '/vue',
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
