import axios from "axios";

export default {
    state: {
        country: [],
        state: [],
        city: [],
        shipstate: [],
        shipcity: []
    },

    getters: {
        getCountry(state) {
            return state.country
        },

        getState(state) {
            return state.state
        },
        
        getCity(state) {
            return state.city
        },

        shipInState(state) {
          return state.shipstate
        },

        shipInCity(state) {
           return state.shipcity
        }

    },

    actions: {
        allCountries(context) {
            axios.get('/api/country').then((response) => {
                context.commit('countries', response.data.countries)
            })
        },

        allStates(context, payload) {
            axios.get('/api/state/' + payload).then((response) => {
               context.commit('states', response.data.states)
            })
        },

        allCities(context, payload) {
            axios.get('/api/city/'+ payload).then((response) => {
                context.commit('cities', response.data.cities)
            })
        },
        /**
         * 
         */
        stateToship(context, payload){
            axios.get('/api/state/' + payload).then((response) => {
                context.commit('shippingState', response.data.states)
             })
        },
        cityToship(context, payload) {
            axios.get('/api/city/'+ payload).then((response) => {
                context.commit('shippingCity', response.data.cities)
            })
        }
    },

    mutations: {
        countries(state, data) {
            return state.country = data
        },

        states(state, payload) {
            return state.state = payload
        },

        cities(state, payload) {
            return state.city = payload
        },

        /**
         * 
         */
        shippingState(state, payload) {
            return state.shipstate = payload
        },
        shippingCity(state, payload) {
            return state.shipcity = payload
        }
    }
}