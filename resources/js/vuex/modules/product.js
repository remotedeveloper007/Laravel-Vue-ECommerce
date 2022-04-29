import axios from "axios";

export default {
    state: {
        /**
         *| For Admin Panel to create State
         * */
        product: [],
        attribute: [],
        proimg: [],
        
        /**
         *| For Public Frontend to create State
         **/
        featureproducts: [],
        singleproduct: [],
        proattribute: [],         
    },

    getters: {
        /**
         *| For Admin Panel to create Getters
         * @param {*} state
         */
        getProduct(state) {
            return state.product;
        },

        getAttribute(state) {
            return state.attribute;
        },

        getProImg(state){
           return state.proimg
        },        

        /**
         *| For Public Frontend to create Getters
         * @param {*} state
         */
        getProducts(state) {
            return state.featureproducts;
        }, 
        
        getSingleProduct(state) {
            return state.singleproduct;
        },
        getProAttributes(state) {
            return state.proattribute;
        },        

    },

    actions: {
        /**
         * For Admin Panel to create laravel route in web.php
         * @param {*} context
         */
        allProduct(context) {
            axios.get("/admin/products").then(response => {
                context.commit("products", response.data.products);
            });
        },
        
        proAttributes(context, payload) {
            axios.get("/admin/attribute/" + payload).then(response => {
                context.commit("attributes", response.data.attributes);
            });
        },

        allProImg(context, payload) {
            axios.get("/admin/productImage/" + payload).then((response) => {
                 context.commit('getImgByProId', response.data.proimage)
            })
        },        
        
        /**
         * For Public Frontend to create laravel route in web.php
         * @param {*} context
         */ 
        fetchAllProduct(context) {
            axios.get("/allproduct").then(response => {
                context.commit("fetchProducts", response.data.fetchProducts);
            });
        },
        
        fetchSingleproduct(context, payload) {
            axios.get("/productDetails/" + payload).then(response => {
                context.commit("getProductById", response.data.productById);
            });
        },

        fetchProAttributes(context) {
            axios.get("/proAttribute").then(response => {
                context.commit("proAttributes", response.data.attributes);
            });
        },        
         
    },

    mutations: {
        /**
         * For Admin Panel to create mutations
         */
        products(state, data) {
            return (state.product = data);
        },
        
        attributes(state, payload) {
            return (state.attribute = payload);
        },

        getImgByProId(state, payload) {
            return state.proimg = payload
        },        

        /**
         * For Public Frontend to create mutations
         */ 
        fetchProducts(state, data) {
            return (state.featureproducts = data);
        },
        
        catProducts(state, payload) {
            return (state.featureproducts = payload);
        },

        subcatProducts(state, payload) {
            return (state.featureproducts = payload);
        },

        getProductById(state, payload) {
            return (state.singleproduct = payload);
        },
        
        proAttributes(state, data) {
            return (state.proattribute = data);
        },        
    }
}