import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

import axios from 'axios';
axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': window.csrf_token
};

import authUser from "../modules/public/authUser";
import product from '../modules/product';
import category from '../modules/category';
import subcategory from '../modules/subcategory';
import cart from '../modules/cart.js';
import coupon from '../modules/coupon';
import country from '../modules/country';
import order from '../modules/order';


const store = new Vuex.Store({

    namespaced: true,

    modules: {
        authUser,
        product,
        category,
        subcategory,
        cart,
        coupon,
        country,
        order
    },

    state: {},

    getters: {},

    actions: {},

    mutations: {}

})

export default store;