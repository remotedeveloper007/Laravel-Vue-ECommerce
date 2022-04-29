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
Vue.component('admin-view', require('./components/admin/AdminMaster.vue').default);

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

//Time format support moment.js used here
import {
    filter
} from './filters/filter'
// window.filter = filterpi
// Vue.mixin({
//     filters: Filters
// });
// moment.js used end here filters

/**9
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import router from './routes/admin/index.js'

import store from './vuex/admin/store.js'

const admin = new Vue({
    // el: '#admin',
    router,
    store,

    /**
     * Create Secutity for Login
     */

    created() {
        const adminString = localStorage.getItem('admin')

        if (adminString) {
            const adminData = JSON.parse(adminString)
            this.$store.commit('SET_ADMIN_DATA', adminData)
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


}).$mount('#admin')
