require('./bootstrap');

window.Vue = require('vue').default;

import axios from 'axios'

import $, {
    get
} from 'jquery';
window.$ = window.jQuery = $;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('seller-view', require('./components/seller/SellerMaster.vue').default);

//v-form Start
import {
    Form,
    HasError,
    AlertError
} from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form; //used globally
//v-form Start End

// Sweet Alert 2 Start ES6 Modules or TypeScript
import Swal from 'sweetalert2'
// import { delete } from 'vue/types/umd';
window.Swal = Swal; //used globally
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast; //used globally
// Sweet Alert 2 Start

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import router from './routes/seller/index.js'

import store from './vuex/seller/store.js'

const seller = new Vue({
    // el: '#seller',
    router,
    store,


    /**
     * Create Secutity for Login
     */

    created() {
        const sellerString = localStorage.getItem('seller')

        if (sellerString) {
            const sellerData = JSON.parse(sellerString)
            this.$store.commit('SET_SELLER_DATA', sellerData)
        }

        axios.interceptors.response.use(
            response => response,
            error => {
                if (error.response.status === 401) {
                    this.$store.dispatch('logout')
                }
                return Promise.reject(error)
            }
        )
    },



}).$mount('#seller')
