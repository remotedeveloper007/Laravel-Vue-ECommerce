import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

import axios from 'axios';
axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': window.csrf_token
};

import sellerAuth from "../modules/seller/authSeller.js";


const store = new Vuex.Store({

    namespaced: true,

    modules: {
        sellerAuth,
    },

    state: {},

    getters: {},

    actions: {},

    mutations: {}

})

export default store;