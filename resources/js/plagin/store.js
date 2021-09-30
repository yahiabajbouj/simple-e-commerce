import Vue from "vue";
import Vuex from "vuex";
import Product from "../modules/product/store";
import Order from "../modules/order/store";
Vue.use(Vuex);

export const store = new Vuex.Store({
    modules: {
        Product,
        Order
    },
    state: {
    },
    getters: {
    },
    mutations: {
    },
    actions: {
    }
});
