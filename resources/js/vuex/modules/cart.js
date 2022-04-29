import axios from "axios";


export default {
    state: {
        //For Frontend
        cart: [],
        review:[],
    },

    mutations: {

        /**
         * For Frontend
         */
        usersCart(state, data) {
            return (state.cart = data);
        },
        /**
         */
        reviewOrder(state, data) {
            return (state.review = data)
        }   
    },

    actions: {
        /**
         * For Public Frontend to create laravel route in web.php
         * @param {*} context
         */

        fetchCart(context) {
            axios.get("/api/my-cart").then(response => {
                context.commit("usersCart", response.data.cart)
            })
        },
        /**
         * 
         * @param {*} context 
         */
        orderReview(context) {
            axios.get('/api/order-review').then(response => {
                context.commit('reviewOrder', response.data.reviewCart)
            })
        },

    },

    getters: {
        /**
         *| Front End Getters
         * @param {*} state
         */
        getCart(state) {
            return state.cart
        },
        /**
         * 
         * @param {*} state 
         */
        reviewCart(state) {
            return state.review
        }
    }
}