import { mapGetters } from 'vuex'

export const userComputed = {
    ...mapGetters(['userLoggedIn'])
}

export const adminComputed = {
    ...mapGetters(['adminLoggedIn'])
}

export const sellerComputed = {
    ...mapGetters(['sellerLoggedIn'])
}