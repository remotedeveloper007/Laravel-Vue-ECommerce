import axios from "axios";


export default {
    state: {
        //For Admin Panel
        coupon: [],
    },

    getters: {
        /**
         *|For Admin Panel Getters
         * @param {*} state
         */
        getCoupon(state) {
            return state.coupon
        },
    },

    actions: {
        /**
         * For Admin Frontend to create laravel route in web.php
         * @param {*} context
         */

        allCoupon(context) {
            axios.get('/admin/coupon').then((response) => {
                context.commit('coupons', response.data.coupon)
            });
        },
        /**
         * For Public Frontend to create laravel route in web.php
         * @param {*} context
         */

    },

    mutations: {

        /**
         * For Admin Panel
         */
        coupons(state, data) {
            return state.coupon = data
        },
    },    
}