require('./bootstrap');

window.Vue = require('vue').default;

import axios from 'axios';

import $, {
    get
} from 'jquery';
window.$ = window.jQuery = $;

// import Carousel3d from 'vue-carousel-3d';
// Vue.use(Carousel3d);

import VueGlide from 'vue-glide-js'
// import 'vue-glide-js/dist/vue-glide.css'
Vue.use(VueGlide)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

//  Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('public-view', require('./components/public/PublicMaster.vue').default);


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
    timer: 8000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.Toast = Toast; //used globally
// Sweet Alert 2 Start

/**
 * import Vue-Progressbar and create global instance
 */
import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    timer: 5000,
    timerProgressBar: true,
    height: '50px'
})

//Time format support moment.js used here
import {
    filter
} from './filters/filter'
// window.filter = filter
// moment.js used end here 

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import router from './routes/public/index.js'

import store from './vuex/public/store.js'


const app = new Vue({
    el: '#app',
    router,
    store,

    /**
     * Create Secutity for Login
     */

    created() {

        const userString = localStorage.getItem('user')

        if (userString) {
            const userData = JSON.parse(userString)
            this.$store.commit('SET_USER_DATA', userData)
        }

        axios.interceptors.response.use(
            response => response,
            error => {
                if (error.response.status === 401) {
                    this.$store.commit('CLEAR_USER_DATA')
                    // this.$store.dispatch('logout')
                }
                return Promise.reject(error)
            }
        )

    },

});
