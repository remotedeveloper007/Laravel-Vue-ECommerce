import axios from "axios";

export default {
    state: {
        /**
         *| For Admin Panel to create State
         * */
        order: [],
        orderDetail: [],
        /**
         *| For Public Frontend to create State
         * */

        details: [],
    },

    getters: {
        /**
         *| For Admin Panel to create Getters
         * @param {*} state
         */
        getOrder(state){
            return state.order;
        },
        fetchDetails(state){
            return state.orderDetail;
        },

        /**
         * For User to create Getters
         * @param {*} state 
         */
        getDetails(state) {
            return state.details;
        },
    },

    actions: {
        /**
         * For Admin Panel to create laravel route in web.php
         * @param {*} context
         */
        allOrder(context) {
            axios.get('/admin/view-order').then(res => {
                context.commit('fetchOrders', res.data.order);
            });
        },
        fetchOrderDetails(context, payload){
            axios.get('/admin/view-order/' + payload).then(response => {
                context.commit('fetchAllDetails', response.data.order)
            });
         },
        /**
         *  For Public Frontend  to create laravel route in web.php
         * @param {*} context
         */
        getOrderDetails(context, payload) {
            axios.get('/api/ordersDetail/' + payload).then(response => {
                context.commit('orderDetails', response.data.order);
            });
        }
    },

    mutations: {
        /**
         * For Admin Panel to create laravel route in web.php
         * @param {*} context
         */
        fetchOrders(state, data) {
            return state.order = data;
        },
        fetchAllDetails(state, payload) {
            return state.orderDetail = payload
        },

        /**
         *  For Public Frontend to create mutations
         * @param {*} context
         */       
        orderDetails(state, payload) {
            return state.details = payload;
        },

    }
};
