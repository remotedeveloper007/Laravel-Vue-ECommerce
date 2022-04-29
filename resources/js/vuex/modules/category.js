import axios from "axios";

export default {
    state: {
        /**
         *| For Admin Panel to create State
         * */
        category: [],

        /**
         *| For Public Frontend to create State
         **/
        categories: [],         
    },

    getters: {
        /**
         *| For Admin Panel to create Getters
         * @param {*} state
         */
        getCategory(state) {
            return state.category;
        },

        /**
         *| For Public Frontend to create Getters
         * @param {*} state
         */
        getCategories(state) {
            return state.categories;
        },        

    },

    actions: {
        /**
         * For Admin Panel to create laravel route in web.php
         * @param {*} context
         */
        allCategory(context) {
            axios
                .get("/admin/category") //create this route::get('/category) in web.php
                .then(response => {
                    context.commit("categories", response.data.categories); //categories from CategoryController
                });
        },        
        
        /**
         * For Public Frontend to create laravel route in web.php
         * @param {*} context
         */
        fetchAllCategories(context) {
            axios.get("/allCategory").then(response => {
                context.commit("fetchCategories", response.data.categories);
            });
        }, 
        
        fetchCatPro(context, payload) {
            axios.get("/catproduct/" + payload).then(response => {
                context.commit("catProducts", response.data.catproducts);
            });
        },        
    },

    mutations: {
        /**
         * For Admin Panel to create mutations
         */
        categories(state, data) {
            return (state.category = data);
        },        

        /**
         * For Public Frontend to create mutations
         */  
        fetchCategories(state, payload) {
            return (state.categories = payload);
        },               
    }
}