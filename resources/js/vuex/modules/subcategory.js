import axios from "axios";

export default {
    state: {
        /**
         *| For Admin Panel to create State
         * */
        subcategory: [],
        
        /**
         *| For Public Frontend to create State
         **/
        subcategories: [],         
    },

    getters: {
        /**
         *| For Admin Panel to create Getters
         * @param {*} state
         */
        getSubcategory(state) {
            return state.subcategory;
        },

        /**
         *| For Public Frontend to create Getters
         * @param {*} state
         */
        getSubcategories(state) {
            return state.subcategories;
        },        

    },

    actions: {
        /**
         * For Admin Panel to create laravel route in web.php
         * @param {*} context
         */
        allSubcategory(context) {
            axios.get("/admin/subcategory").then(response => {
                context.commit("subcategories", response.data.subcategories);
            });
        },        
        
        /**
         * For Public Frontend to create laravel route in web.php
         * @param {*} context
         */  
        fetchAllSubcategories(context) {
            axios.get("/allSubcategory").then(response => {
                context.commit(
                    "fetchSubcategories",
                    response.data.subcategories
                );
            });
        },

        fetchSubcatPro(context, payload) {
            axios.get("/subcatproduct/" + payload).then(response => {
                context.commit("subcatProducts", response.data.subcatproducts);
            });
        },                
         
    },

    mutations: {
        /**
         * For Admin Panel to create mutations
         */
        subcategories(state, data) {
            return (state.subcategory = data);
        },        

        /**
         * For Public Frontend to create mutations
         */
        fetchSubcategories(state, payload) {
            return (state.subcategories = payload);
        },                 
    }
}