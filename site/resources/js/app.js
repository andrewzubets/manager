import "./bootstrap";
import { createApp, createSSRApp  } from "vue";
import {createWebHistory} from "vue-router";

import createRouter from './Routing/router';

const router = createRouter(createWebHistory())
import RootComponent from "../vue/RootComponent.vue";

const app = createApp (RootComponent, window.PS);
delete window.PS;
app.use(router);
const vm = app.mount('#app');
