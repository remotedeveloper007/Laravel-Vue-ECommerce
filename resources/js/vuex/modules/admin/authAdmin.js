import axios from "axios";
// import { authComputed } from '../helper';


export default {

    state: {
        status: '',
        // token: '',
        admin: null,
        session: null,
        // profile: {}
    },

    mutations: {
        /**
         * @param {*} state 
         */
        SET_ADMIN_DATA(state, adminData) {
            state.admin = adminData
            state.session = `${adminData.session}`
            // state.token = `${adminData.token}`
            if(state.session == 'undefined') {
                this.$router.push({ name: 'Admin Login' }),
                location.reload()
            } else {
                localStorage.setItem('admin', JSON.stringify(adminData))
                sessionStorage.setItem('session', JSON.stringify(adminData.session))
            }
            // axios.defaults.headers.common['Authorization'] = `Bearer ${adminData}`          
        },       

        /**
         *   Logout mutations
         * @param {*} state 
         */
        // CLEAR_ADMIN_DATA(state) {
        //     state.admin = null
        //     // state.token = null
        //     state.session = null
        //     localStorage.removeItem('admin')
        //     sessionStorage.removeItem('session')
        //     // axios.defaults.headers.common['Authorization'] = null
        //     // location.reload()
        // }, 
        
        CLEAR_ADMIN_DATA() {
            localStorage.removeItem('admin')
            sessionStorage.removeItem('session')
            location.reload()
        },

        GET_ADMIN_DATA(state, payload) {
            return state.admin = payload
        }

    },

    actions: {
        /**
         * Login a Admin
         * 
         * @param context {Object} 
         * @param credentials {Object} User credentials
         * @param credentials.email {string} User email
         * @param credentials.password {string} User password
         */
        login({ commit }, credentials) {
            return axios.post('/admin/login', credentials).then(({ data }) => { 
                // commit it
                commit('SET_ADMIN_DATA', data)
            })

        },

        /**
         * 
         * @param {*} context 
         */
        myProfile(context) {
            const token = axios.defaults.headers.common['Authorization']
            if (token) {
                return axios.get('/admin/my-account').then((response) => {
                    context.commit('GET_ADMIN_DATA', response.data.authUser)
                })
            } 
            // else {
            //     this.$router.push({ name: 'login' });
            // }
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
            commit('CLEAR_ADMIN_DATA')
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
        adminLoggedIn(state) {
            return !!state.session
            // return !!state.token
        },

        // isLoggedIn: state => !!state.token,

        authStatus: state => !!state.session,
        /**
         *| For Public Frontend to create Getters
         * @param {*} state
         */
        getProfile(state) {
            return state.admin;
        },

    },

}