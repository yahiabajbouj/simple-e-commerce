require("./bootstrap");
window.Vue = require("vue");
import Vue from "vue";

import App from "./App.vue";
import { router } from "./plagin/routes";
import { store } from "./plagin/store";
import vuetify from "./plagin/vuetify";
import "@mdi/font/css/materialdesignicons.css";

const app = new Vue({
    el: "#app",
    router,
    store,
    vuetify,
    render: h => h(App)
});