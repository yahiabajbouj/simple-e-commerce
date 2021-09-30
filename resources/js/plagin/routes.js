import Vue from 'vue'
import VueRouter from "vue-router";
import productRoute from '../modules/product/routes';
import orderRoute from '../modules/order/routes';
Vue.use(VueRouter)

const Routes = [
    ...productRoute,
    ...orderRoute,
];

export const router = new VueRouter({
    routes: Routes,
    mode: "history"
});