import axios from "axios";
// import { authComputed } from '../helper';


export default {

    state: {
        status: '',
        // token: '',
        seller: null,
        session_id: null,
        profile: {}
    },

    mutations: {
        /**
         * 
         * @param {*} state 
         */
        SET_SELLER_DATA(state, sellerData) {
            state.seller = sellerData
            state.session_id = `${sellerData.session}`
            // state.token = `${sellerData.token}`
            if(state.session_id == 'undefined') {
                this.$router.push({ name: 'Seller Login' }),
                location.reload()
            } else {
                localStorage.setItem('seller', JSON.stringify(sellerData))
                sessionStorage.setItem('session_id', JSON.stringify(sellerData.session))
                // axios.defaults.headers.common['Authorization'] = `Bearer ${sellerData.token}` 
            }
         
        },       

        /**
         *   Logout mutations
         * @param {*} state 
         */
        // CLEAR_SELLER_DATA(state) {
        //     state.seller = null
        //     // state.token = null
        //     state.session_id = null
        //     localStorage.removeItem('seller')
        //     sessionStorage.removeItem('session_id')
        //     // axios.defaults.headers.common['Authorization'] = null
        // },
        CLEAR_SELLER_DATA() {
            localStorage.removeItem('seller')
            sessionStorage.removeItem('session_id')
            location.reload()
        },                  

        GET_SELLER_DATA(state, payload) {
            return state.seller = payload
        }

    },

    actions: {
        register({ commit }, credentials) {
            return axios.post('/seller/register', credentials).then(({ data }) => {
                // retrieve access token

                // commit it
                commit('SET_SELLER_DATA', data)
            })
        },       


        /**
         * Login a user
         * 
         * @param context {Object} 
         * @param credentials {Object} User credentials
         * @param credentials.email {string} User email
         * @param credentials.password {string} User password
         */
        login({ commit }, credentials) {
            return axios.post('/seller/login', credentials).then(({ data }) => {
                
                // retrieve access token
                // const token = response.data.token
                // const data  = response.data.user

                // commit it
                commit('SET_SELLER_DATA', data)
            })

        },

        /**
         * 
         * @param {*} context 
         */
        myProfile(context) {
            // const token = axios.defaults.headers.common['Authorization']
            if (token) {
                return axios.get('/seller/my-account').then((response) => {
                    context.commit('GET_SELLER', response.data.authUser)
                })
            } 
        },

        /**
         * 
         * @param {*} param0 
         */


        /**
         * 
         * @param {*} state 
         */
        logout({ commit }) {
            //commit
            commit('CLEAR_SELLER_DATA')
        },

        /**
         * 
         * @param {*} state 
         */
        // deleteUser({ commit }) {
        //     commit('CLEAR_ADMIN_DATA')
        // }
    },

    getters: {
        sellerLoggedIn(state) {
            return !!state.seller
            // return !!state.token
        },

        // isLoggedIn: state => !!state.token,

        authStatus: state => state.status,
        /**
         *| For Public Frontend to create Getters
         * @param {*} state
         */
        getProfile(state) {
            return state.seller;
        },

    },

}