import "./bootstrap";
import { createApp } from "vue";
import RootComponent from "../vue/RootComponent.vue";

const app = createApp(RootComponent)
const vm = app.mount('#app')
