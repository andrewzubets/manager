import "./bootstrap";
import { createApp, createSSRApp  } from "vue";
import {createWebHistory} from "vue-router";

import createRouter from './Routing/router';
import RootComponent from "./Layout/Main.vue";

const router = createRouter(createWebHistory());
let PS = {};
if(typeof window['PS'] !== undefined) {
    PS = window['PS'];
    delete window['PS'];
}

const app = createApp (RootComponent, PS);

app.use(router);
const vm = app.mount('#app');
