import axios from "axios";
// import { authComputed } from '../helper';


export default {

    state: {
        status: '',
        token: null,
        user: null,
        session: null,
        profile: null,
        errors: {}
    },

    mutations: {
        /**
         * Register mutations
         * @param {*} state 
         * @param {*} userData 
         */
        SET_REGISTER_DATA(state, userData) {
            state.errors = userData
        },

        /**
         * Login mutations
         * @param {*} state 
         */
        SET_USER_DATA(state, userData) {
            state.user = userData
            state.session = `${userData.session}`
            state.token = `${userData.token}`
            localStorage.setItem('user', JSON.stringify(userData))
            sessionStorage.setItem('session', JSON.stringify(userData.session))
            axios.defaults.headers.common['Authorization'] = `Bearer ${userData.token}`
        },

        /**
         *   Logout mutations
         * @param {*} state 
         */
        CLEAR_USER_DATA(state) {
            state.user = ''
            // state.token = ''
            // state.session = ''
            localStorage.removeItem('user')
            sessionStorage.removeItem('session')
            axios.defaults.headers.common['Authorization'] = null
            // location.reload()
        },

        GET_USER_DATA(state, payload) {
            return state.user = payload
        }

    },

    actions: {
        register({ commit }, credentials) {
            return axios.post('/api/register', credentials).then(({ data }) => {
                // retrieve access token

                // commit it
                commit('SET_REGISTER_DATA', data)
                // this.$router.push({ name: "Verify Email" });
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
            return axios.post('/api/login', credentials).then(({ data }) => {
                // commit it
                commit('SET_USER_DATA', data)
            })

        },

        /**
         * 
         * @param {*} context 
         */
        myProfile(context) {
            if (axios.defaults.headers.common["Authorization"]) {
                return axios.get('/api/my-account').then((response) => {
                    context.commit('GET_USER_DATA', response.data.authUser)
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
            // return axios.get('/api/logout').then(() => {
            return axios.post('/api/logout').then(() => {
                commit('CLEAR_USER_DATA')
                resolve()
                this.$router.push({ name: "login" });
            })
        },


        /**
         * 
         * @param {*} state 
         */
        deleteUser({ commit }) {
            commit('CLEAR_USER_DATA')
        }
    },

    getters: {
        userLoggedIn(state) {
            return !!state.user
        },

        authStatus: state => !!state.token,
        /**
         *| For Public Frontend to create Getters
         * @param {*} state
         */
        getProfile(state) {
            return state.user;
        },

    },

}